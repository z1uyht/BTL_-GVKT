from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

BASE_URL = "http://localhost/team19.thoitrangstore.com"

options = webdriver.ChromeOptions()
driver = webdriver.Chrome(options=options)
wait = WebDriverWait(driver, 10)

def login(email, password):
    print("🔐 Đang đăng nhập...")
    driver.get(f"{BASE_URL}/login.php")
    try:
        wait.until(EC.presence_of_element_located((By.NAME, "user_email"))).send_keys(email)
        driver.find_element(By.NAME, "user_pass").send_keys(password)
        driver.find_element(By.NAME, "user_login").click()
        time.sleep(2)
        if "login.php" in driver.current_url:
            print("❌ Đăng nhập thất bại.")
        else:
            print("✅ Đăng nhập thành công.")
    except Exception as e:
        print(f"❌ Lỗi đăng nhập: {e}")

def add_to_cart_test(color, size, expected_keywords):
    print(f"🛒 Đang kiểm thử giỏ hàng với màu: {color}, size: {size}")
    try:
        driver.get(f"{BASE_URL}/product-detail.php?id=1")

        if color:
            wait.until(EC.element_to_be_clickable((By.CSS_SELECTOR, f'a.choice-color[data-color="{color}"]'))).click()
        if size:
            wait.until(EC.element_to_be_clickable((By.CSS_SELECTOR, f'a.choice-size[data-size="{size}"]'))).click()

        wait.until(EC.element_to_be_clickable((By.CSS_SELECTOR, 'button.button-add-to-cart'))).click()
        time.sleep(1)

        page_source = driver.page_source.lower()
        if any(keyword.lower() in page_source for keyword in expected_keywords):
            print("✅ PASS")
        else:
            print("❌ FAIL - Không thấy từ khóa kỳ vọng")
            print(f"🔍 Nội dung trang (500 ký tự đầu):\n{driver.page_source[:500]}")
    except Exception as e:
        print(f"❌ EXCEPTION - {e}")

# Đăng nhập trước
login("btbohuy@gmail.com", "123456789")

# Danh sách test
add_to_cart_test_cases = [
    {
        "color": "black",
        "size": "M",
        "expect": ["đã thêm vào giỏ", "giỏ hàng", "cart"]
    },
    {
        "color": "pink",
        "size": "M",
        "expect": ["không tồn tại", "chọn màu", "lỗi"]
    },
    {
        "color": "black",
        "size": "XXXL",
        "expect": ["không tồn tại", "chọn kích thước", "lỗi"]
    },
    {
        "color": None,
        "size": "L",
        "expect": ["vui lòng chọn màu", "chọn màu"]
    },
    {
        "color": "blue",
        "size": None,
        "expect": ["vui lòng chọn kích thước", "chọn size"]
    },
    {
        "color": None,
        "size": None,
        "expect": ["vui lòng chọn", "không được bỏ trống"]
    }
]

# Chạy test
for test in add_to_cart_test_cases:
    add_to_cart_test(test["color"], test["size"], test["expect"])
    print("-" * 50)

driver.quit()
