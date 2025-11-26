const axios = require('axios');
const { v4: uuidv4 } = require('uuid');
const { faker } = require('@faker-js/faker');

const ERROR_RATE = 0.025;
const ERROR_FIELDS = ['message_uuid', 'from', 'timestamp', 'text'];

function generateWebhookPayload() {
    const payload = {
        channel: "rcs",
        message_uuid: uuidv4(),
        to: "Vonage",
        from: faker.phone.number({ style: 'international' }).replace('+', ''),
        timestamp: new Date().toISOString(),
        context_status: "none",
        message_type: "text",
        text: faker.lorem.text().slice(0, 300)
    };

    if (Math.random() < ERROR_RATE) {
        const fieldToRemove = faker.helpers.arrayElement(ERROR_FIELDS);
        delete payload[fieldToRemove];
        console.warn(`[WARN] Sending malformed webhook (missing '${fieldToRemove}')`);
    }

    return payload;
}

function sendWebhook() {
    const payload = generateWebhookPayload();

    axios.post('http://tutorial-voice-rcs_laravel_nightwatch.test/webhook', payload)
        .then(() => {
            console.log(`[${new Date().toISOString()}] Sent: ${payload.message_uuid}`);
        })
        .catch(error => {
            console.error(`[${new Date().toISOString()}] Error: ${error.message}`);
        });
}

setInterval(sendWebhook, 200);

console.log("Running Mock Webhook Server");
