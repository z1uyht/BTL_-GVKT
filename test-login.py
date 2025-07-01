from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

BASE_URL = "http://localhost/team19.thoitrangstore.com"

options = webdriver.ChromeOptions()
driver = webdriver.Chrome(options=options)
wait = WebDriverWait(driver, 10)

def login_test(user_data, expected_keywords):
    print(f"🔄 Đang kiểm thử đăng nhập với: {user_data}")
    driver.get(f"{BASE_URL}/login.php")

    try:
        wait.until(EC.presence_of_element_located((By.NAME, "user_email"))).send_keys(user_data.get("email", ""))
        driver.find_element(By.NAME, "user_pass").send_keys(user_data.get("password", ""))
        driver.find_element(By.NAME, "user_login").click()
        time.sleep(2)

        page_source = driver.page_source.lower()
        if any(keyword.lower() in page_source for keyword in expected_keywords):
            print("✅ PASS")
        else:
            print("❌ FAIL - Không tìm thấy từ khóa kỳ vọng")
            print(f"🔍 Nội dung trang (500 ký tự đầu):\n{driver.page_source[:500]}")
    except Exception as e:
        print(f"❌ Lỗi kiểm thử đăng nhập: {e}")

# Danh sách test case
login_test_cases = [
    {
        "case": {"email": "btbohuy0212@gmail.com", "password": "123456789"},
        "expect": ["logout", "trang chủ", "chào", "tài khoản"]
    },
    {
        "case": {"email": "btbohuy@gmail.com", "password": "saimatkhau"},
        "expect": ["sai mật khẩu", "mật khẩu không đúng", "đăng nhập thất bại"]
    },
    {
        "case": {"email": "nonexist@example.com", "password": "12345678"},
        "expect": ["email không tồn tại", "tài khoản không hợp lệ"]
    },
    {
        "case": {"email": "", "password": "12345678"},
        "expect": ["vui lòng nhập", "email"]
    },
    {
        "case": {"email": "btbohuy@gmail.com", "password": ""},
        "expect": ["vui lòng nhập", "mật khẩu"]
    },
    {
        "case": {"email": "abc@@gmail", "password": "12345678"},
        "expect": ["email không hợp lệ", "email sai"]
    }
]

# Chạy test
for test in login_test_cases:
    login_test(test["case"], test["expect"])
    print("-" * 50)

driver.quit()
