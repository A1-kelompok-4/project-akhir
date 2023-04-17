const saveData = (event) => {

    event.preventDefault();

    // Retrieve - Start
    const email = document.getElementById("email").value;
    const username = document.getElementById("user").value;
    const password = document.getElementById("pass").value;
    const con_password = document.getElementById("con_pass").value;
    // Retrieve - End

    // Storage Check - Start
    let data = JSON.parse(localStorage.getItem("users")) || [];
    // Storage Check - End

    // Validation - Start
    let isEmailExist = data.some(user => user.email === email);
    let isUserExist = data.some(user => user.username === username);
    if (isEmailExist) {
        alert("Email already exists!");
        return;
    }
    if (isUserExist) {
        alert("Username already exists!");
        return;
    }
    if (password !== con_password){
        alert("Password Tidak Cocok");
        return;
    }
    if(password.length < 5){
        alert("Password Minimal 5 huruf atau angka !");
        return;
    }
    // Validation - End

    // Saving - Start
    alert("Berhasil");
    data.push({email,username,password});
    localStorage.setItem("users", JSON.stringify(data));
    // Saving - End
    return window.location.href = "login.html";
};


// Define the arrow function to handle login
const handleLogin = (event) => {
    // Prevent the form from submitting
    event.preventDefault();

    // Get the input values
    let username = document.getElementById("user").value;
    let password = document.getElementById("pass").value;

    // Get the users array from localStorage
    let users = JSON.parse(localStorage.getItem("users")) || [];

    // Find the user with the matching email and password
    let user = users.find(user => user.username === username && user.password === password);

    // If user is not found, show error message
    if (!user) {
        alert("Incorrect email or password!");
        return;
    }

    // Set session storage with user name and redirect to welcome page
    sessionStorage.setItem("username", user.username);
    window.location.href = "index.html";
};

const showGreeting = (username) => {
//   const divElement = document.getElementById('sambutan');
  const waktuElement = document.getElementById('waktu');
  const namaElement = document.getElementById('nama');
  const now = new Date();
  const hour = now.getHours();
  // let usernames = sessionStorage.getItem("username");

  let greeting;
  if (hour >= 5 && hour < 12) {
    greeting = 'Selamat pagi, ';
  } else if (hour >= 12 && hour < 18) {
    greeting = 'Selamat siang, ';
  } else {
    greeting = 'Selamat malam, ';
  }

  waktuElement.innerHTML = greeting;
  namaElement.innerHTML = username;
};

document.addEventListener('DOMContentLoaded', () => {
  const username = sessionStorage.getItem("username");
  showGreeting(username);
});


let cardContainer = document.getElementById("card-container");

// Ambil data registrasi dari session storage dan ubah menjadi objek JavaScript
let registrations = JSON.parse(sessionStorage.getItem("registrations"));

// Loop melalui setiap objek di dalam array, dan untuk setiap objek, buat elemen card baru dengan menggunakan template literal dan isi elemen dengan data dari objek tersebut.
registrations.forEach(registration => {
    let card = document.createElement("div");
    card.classList.add("card");
    card.innerHTML = `
    <h2 class="name">${registration.name}</h2>
    <p class="email">${registration.email}</p>
    <p class="phone">${registration.phone}</p>
    `;

    // tambahkan elemen card ke dalam dokumen HTML
    cardContainer.appendChild(card);
});




let form = document.getElementById("registration-form");

form.addEventListener("submit", event => {
    event.preventDefault(); // mencegah form untuk melakukan submit

    // ambil data dari form dan ubah menjadi objek
    let data = {
    name: form.name.value,
    email: form.email.value,
    phone: form.phone.value
    };

    // simpan data ke session storage
    let registrations = JSON.parse(sessionStorage.getItem("registrations")) || [];
    registrations.push(data);
    sessionStorage.setItem("registrations", JSON.stringify(registrations));

    // redirect ke halaman kedua
    window.location.href = "listform.html";
});
