from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

# URL gốc
BASE_URL = "http://localhost/team19.thoitrangstore.com"

# Khởi tạo trình duyệt
driver = webdriver.Chrome()
driver.maximize_window()
wait = WebDriverWait(driver, 10)

def wait_for_loader_to_disappear(timeout=10):
    for _ in range(timeout * 2):
        try:
            element = driver.find_element(By.CSS_SELECTOR, "div.load-customer")
            style = driver.execute_script("return window.getComputedStyle(arguments[0]).getPropertyValue('display')", element)
            opacity = driver.execute_script("return window.getComputedStyle(arguments[0]).getPropertyValue('opacity')", element)
            if style == "none" or opacity == "0":
                return
        except:
            return
        time.sleep(0.5)

def login(email, password):
    print("🔐 Đang đăng nhập...")
    driver.get(f"{BASE_URL}/login.php")
    wait.until(EC.presence_of_element_located((By.NAME, "user_email"))).send_keys(email)
    driver.find_element(By.NAME, "user_pass").send_keys(password)
    driver.find_element(By.NAME, "user_login").click()
    time.sleep(2)
    if "login.php" not in driver.current_url:
        print("✅ Đăng nhập thành công.")
    else:
        print("❌ Đăng nhập thất bại.")

def add_to_cart(color, size):
    print(f"🛒 Thêm vào giỏ hàng: màu={color}, size={size}")
    driver.get(f"{BASE_URL}/product-detail.php?id=1")
    wait_for_loader_to_disappear()
    wait.until(EC.element_to_be_clickable((By.CSS_SELECTOR, f'a.choice-color[data-color="{color}"]'))).click()
    wait.until(EC.element_to_be_clickable((By.CSS_SELECTOR, f'a.choice-size[data-size="{size}"]'))).click()
    wait.until(EC.element_to_be_clickable((By.CSS_SELECTOR, 'button.button-add-to-cart'))).click()
    time.sleep(1)
    print("✅ Đã thêm vào giỏ thành công")

def go_to_checkout_from_cart():
    print("🧾 Đang chuyển đến trang thanh toán từ giỏ hàng...")
    try:
        driver.get(f"{BASE_URL}/cart.php")
        wait.until(EC.presence_of_element_located((By.ID, "load_price_cart")))

        checkout_btn = wait.until(EC.element_to_be_clickable(
            (By.CSS_SELECTOR, 'div.cart-totals a[href*="checkout.php"]'))
        )
        driver.execute_script("arguments[0].scrollIntoView(true);", checkout_btn)
        driver.execute_script("arguments[0].click();", checkout_btn)
        print("✅ Đã chuyển sang trang thanh toán.")
    except Exception as e:
        print(f"❌ Không thể chuyển sang checkout: {e}")
        driver.save_screenshot("checkout_click_fail.png")

def checkout_test(form_data, expected_keywords):
    print(f"💳 Checkout với dữ liệu: {form_data}")
    try:
        wait_for_loader_to_disappear()

        if "checkout.php" not in driver.current_url:
            print("❌ Không vào được trang checkout.")
            return

        driver.find_element(By.NAME, "lfname").clear()
        driver.find_element(By.NAME, "lfname").send_keys(form_data.get("lfname", ""))
        driver.find_element(By.NAME, "email").clear()
        driver.find_element(By.NAME, "email").send_keys(form_data.get("email", ""))
        driver.find_element(By.NAME, "phone").clear()
        driver.find_element(By.NAME, "phone").send_keys(form_data.get("phone", ""))
        driver.find_element(By.NAME, "address").clear()
        driver.find_element(By.NAME, "address").send_keys(form_data.get("address", ""))
        driver.find_element(By.NAME, "address-city").clear()
        driver.find_element(By.NAME, "address-city").send_keys(form_data.get("address-city", ""))
        driver.find_element(By.NAME, "zipcode").clear()
        driver.find_element(By.NAME, "zipcode").send_keys(form_data.get("zipcode", ""))
        driver.find_element(By.NAME, "note").clear()
        driver.find_element(By.NAME, "note").send_keys(form_data.get("note", ""))

        wait_for_loader_to_disappear()

        submit_btn = wait.until(EC.element_to_be_clickable((By.NAME, "submit")))
        driver.execute_script("arguments[0].scrollIntoView(true);", submit_btn)
        driver.execute_script("arguments[0].click();", submit_btn)
        time.sleep(2)
        wait_for_loader_to_disappear()

        page_source = driver.page_source.lower()
        if any(kw.lower() in page_source for kw in expected_keywords):
            print("✅ Checkout thành công.")
        else:
            print("❌ Checkout thất bại hoặc không có thông báo thành công.")
            driver.save_screenshot("checkout_fail.png")

    except Exception as e:
        print("❌ EXCEPTION:", e)

# ---------------------------
# ✅ BẮT ĐẦU KIỂM THỬ
# ---------------------------

login("btbohuy@gmail.com", "123456789")
add_to_cart("black", "M")
go_to_checkout_from_cart()

checkout_test(
    {
        "lfname": "Huy Đinh",
        "email": "btbohuy0212@gmail.com",
        "phone": "0338580418",
        "address": "123 đường ABC",
        "address-city": "Hà Nội",
        "zipcode": "10000",
        "note": "Giao hàng buổi sáng"
    },
    expected_keywords=["đặt hàng thành công", "cảm ơn", "checkout thành công"]
)

time.sleep(3)
driver.quit()
