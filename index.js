const nodemailer = require('nodemailer');

// Replace with your email credentials
const transporter = nodemailer.createTransport({
  host: 'smtp.gmail.com',
  port: 465,
  secure: true,
  auth: {
    user: 'your_email@gmail.com',
    pass: 'your_password'
  }
});

const mailOptions = {
  from: 'Your Name <your_email@gmail.com>',
  to: 'recipient_email@example.com',
  subject: 'Test Email',
  text: 'This is a test email sent from Node.js.'
};

transporter.sendMail(mailOptions, (error, info) => {
  if (error) {
    console.error(error);
  } else {
    console.log('Email sent: ' + info.response);
  }
});