import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

# Fungsi untuk mengirim email
def send_email(email, password):
    from_email = "your_email@example.com"
    from_password = "your_email_password"
    to_email = email

    subject = "Password Reset"
    message = "Your new password is: " + password

    msg = MIMEMultipart()
    msg['From'] = from_email
    msg['To'] = to_email
    msg['Subject'] = subject

    msg.attach(MIMEText(message, 'plain'))

    server = smtplib.SMTP('smtp.gmail.com', 587)
    server.starttls()
    server.login(from_email, from_password)
    text = msg.as_string()
    server.sendmail(from_email, to_email, text)
    server.quit()

# Fungsi untuk mengubah password
def reset_password():
    email = input("Enter your email: ")
    # Lakukan validasi email
    # Jika email valid, buat password baru
    new_password = "new_password"
    # Kirim email dengan password baru
    send_email(email, new_password)
    print("Your password has been reset. Please check your email.")

# Panggil fungsi reset_password
reset_password()