from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

# Tạo đối tượng Options để cấu hình Chrome
chrome_options = Options()
# Không sử dụng chế độ headless
# chrome_options.add_argument("--headless")  # Nếu muốn headless thì bỏ comment dòng này

driver = webdriver.Chrome(options=chrome_options)
wait = WebDriverWait(driver, 10)

BASE_URL = "http://localhost/team19.thoitrangstore.com"  # Cập nhật theo URL của bạn

def register_test(user_data, expected_keywords):
    print(f"🧪 Đang kiểm thử: {user_data}")
    driver.get(f"{BASE_URL}/register.php")

    # Điền dữ liệu nếu có
    if "first_name" in user_data:
        wait.until(EC.presence_of_element_located((By.NAME, "first-name"))).send_keys(user_data["first_name"])
    if "last_name" in user_data:
        driver.find_element(By.NAME, "last-name").send_keys(user_data["last_name"])
    if "email" in user_data:
        driver.find_element(By.NAME, "email").send_keys(user_data["email"])
    if "password" in user_data:
        driver.find_element(By.NAME, "password").send_keys(user_data["password"])
    if "password_confirm" in user_data:
        driver.find_element(By.NAME, "password-confirm").send_keys(user_data["password_confirm"])
    if "phone" in user_data:
        driver.find_element(By.NAME, "phone").send_keys(user_data["phone"])

    # Đợi phần tử loading nếu có
    try:
        WebDriverWait(driver, 5).until(EC.invisibility_of_element_located((By.CLASS_NAME, "load-customer")))
    except:
        pass  # Không có cũng không sao

    # Dùng JavaScript click để tránh bị che khuất
    try:
        register_btn = driver.find_element(By.NAME, "userRegistration")
        driver.execute_script("arguments[0].click();", register_btn)
    except Exception as e:
        print("❌ Không thể click nút đăng ký:", str(e))
        return

    # Đợi xử lý backend
    time.sleep(2)

    # Kiểm tra kết quả
    page_source = driver.page_source.lower()
    if any(keyword.lower() in page_source for keyword in expected_keywords):
        print("✅ PASS")
    else:
        print("❌ FAIL - Không tìm thấy từ khóa kỳ vọng")
        print(f"🔍 Nội dung trang (500 ký tự đầu):\n{driver.page_source[:500]}")

# Test code này
test_cases = [
    # ✅ 1. Đăng ký thành công
    {
        "case": {
            "first_name": "Huy",
            "last_name": "Nguyen",
            "email": "huy123@example.com",
            "password": "Abc12345",
            "password_confirm": "Abc12345",
            "phone": "0987654321"
        },
        "expect": ["đăng ký thành công", "đăng nhập", "login"]
    },

    # ❌ 2. Thiếu họ
    {
        "case": {
            "first_name": "Linh",
            "email": "test2@example.com",
            "password": "Abc12345",
            "password_confirm": "Abc12345",
            "phone": "0987654321"
        },
        "expect": ["vui lòng nhập", "last name", "họ"]
    },

    # ❌ 3. Thiếu email
    {
        "case": {
            "first_name": "Mai",
            "last_name": "Tran",
            "password": "Abc12345",
            "password_confirm": "Abc12345",
            "phone": "0987654321"
        },
        "expect": ["vui lòng nhập", "email"]
    },

    # ❌ 4. Email sai định dạng
    {
        "case": {
            "first_name": "Nam",
            "last_name": "Pham",
            "email": "sai-email",  # Sai định dạng
            "password": "Abc12345",
            "password_confirm": "Abc12345",
            "phone": "0987654321"
        },
        "expect": ["email không hợp lệ", "email invalid", "email sai"]
    },

    # ❌ 5. Mật khẩu không khớp
    {
        "case": {
            "first_name": "Tuan",
            "last_name": "Le",
            "email": "tuan123@example.com",
            "password": "Abc12345",
            "password_confirm": "Abc99999",  # Không khớp
            "phone": "0987654321"
        },
        "expect": ["mật khẩu không khớp", "password không đúng"]
    },

    # ❌ 6. Số điện thoại không hợp lệ (chứa chữ)
    {
        "case": {
            "first_name": "Hoa",
            "last_name": "Nguyen",
            "email": "hoa999@example.com",
            "password": "Abc12345",
            "password_confirm": "Abc12345",
            "phone": "abc1234567"  # Sai định dạng
        },
        "expect": ["số điện thoại không hợp lệ", "phone invalid"]
    },

    # ❌ 7. Email đã tồn tại
    {
        "case": {
            "first_name": "Huy",
            "last_name": "Nguyen",
            "email": "huy123@example.com",  # Đã đăng ký ở TC1
            "password": "Abc12345",
            "password_confirm": "Abc12345",
            "phone": "0987654321"
        },
        "expect": ["email đã tồn tại", "đã có tài khoản"]
    }
]

for test in test_cases:
    register_test(test["case"], test["expect"])
    print("-" * 50)

driver.quit()