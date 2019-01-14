// Get loginModal element
var loginModal = document.getElementById('loginModal');
// Get open loginModal button
var loginBtn = document.getElementById('loginBtn');
// Get close butten
var closeBtn = document.getElementsByClassName('closeBtn')[0];
var close2 = document.getElementsByClassName('closeBtn')[1];
// Get registerModal element
var registerModal = document.getElementById('registerModal');
// Get register button
var registerBtn = document.getElementById('registerBtn');

// Login
loginBtn.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);
window.addEventListener('click', outsideClick);
window.addEventListener('click', outsideClick2);
// Register
registerBtn.addEventListener('click', openRegModal);
close2.addEventListener('click', closeRegModal);

// Function to open loginModal
function openModal()
{
    loginModal.style.display = 'block';
    registerBtn.disabled = true;
}
// Function to open registerModal
function openRegModal()
{
    registerModal.style.display = 'block';
}
// Function to close loginModal
function closeModal()
{
    loginModal.style.display = 'none';
    registerBtn.disabled = false;
}
// Function to close registerModal
function closeRegModal()
{
    registerModal.style.display = 'none';
}

// Function to close loginModal without closeBtn
function outsideClick(e)
{
    if (e.target == registerModal)
    {
        registerModal.style.display = 'none';
    }
}

function outsideClick2(e)
{
    if (e.target == loginModal)
    {
        loginModal.style.display = 'none';
        registerBtn.disabled = false;
    }
}