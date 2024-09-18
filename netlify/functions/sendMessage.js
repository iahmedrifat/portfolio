const fetch = require('node-fetch');

exports.handler = async function (event, context) {
  const { name, email, subject, message } = JSON.parse(event.body);

  const telegramMessage = `Contact Form Submission:\n\nName: ${name}\nEmail: ${email}\nSubject: ${subject}\nMessage: ${message}`;

  const botToken = '6324640153:AAHRE-unKqefW9TSIsjg9fUeXH3HqI3EhvE';
  const chatId = '5755109067';
  const telegramApiUrl = `https://api.telegram.org/bot${botToken}/sendMessage?chat_id=${chatId}&text=${encodeURIComponent(telegramMessage)}`;

  try {
    const response = await fetch(telegramApiUrl);
    const data = await response.json();

    if (data.ok) {
      return {
        statusCode: 200,
        body: JSON.stringify({ message: 'Message sent successfully!' }),
      };
    } else {
      return {
        statusCode: 500,
        body: JSON.stringify({ message: `Error sending message: ${data.description}` }),
      };
    }
  } catch (error) {
    return {
      statusCode: 500,
      body: JSON.stringify({ message: `Error: ${error.message}` }),
    };
  }
};
