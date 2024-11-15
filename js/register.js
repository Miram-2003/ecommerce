
document.getElementById('registrationForm').addEventListener('submit', function (event) {
    event.preventDefault(); 
    
    const name = document.getElementById('name').value.trim();
    const store = document.getElementById('store_name').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const country = document.getElementById('country').value.trim();
    const region = document.getElementById('region').value.trim();
    const city = document.getElementById('city').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

   
    let isValid = true;
    document.getElementById('nameError').textContent = '';
    document.getElementById('storeError').textContent = '';
    document.getElementById('phoneError').textContent = '';
    document.getElementById('emailError').textContent = '';
    document.getElementById('phoneError').textContent = '';
    document.getElementById('countryError').textContent = '';
    document.getElementById('regionError').textContent = '';
    document.getElementById('emailError').textContent = '';
    document.getElementById('cityError').textContent = '';
    document.getElementById('logoError').textContent = '';
    document.getElementById('passwordError').textContent = '';
    document.getElementById('confirmPasswordError').textContent = '';


    const nameRegex = /^[a-zA-Z\s]{3,50}$/; // 3-50 characters, letters only
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Email format
    const phoneRegex = /^\d{10,15}$/; // 10-15 digits
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; // At least 8 characters, one letter, one number
    const textFieldRegex = /^[a-zA-Z\s]{2,50}$/;


    // Validate Name
    if (!name || name === ' ') {
        document.getElementById('nameError').textContent = 'Name is required.';
        isValid = false;
    } else if (!nameRegex.test(name)) {
        document.getElementById('nameError').textContent = 'Name must be 3-50 characters long and contain only letters and spaces.';
        isValid = false;
    }

    // Validate Email
    if (!email || email === ' ') {
        document.getElementById('emailError').textContent = 'Email is required.';
        isValid = false;
    } else if (!emailRegex.test(email)) {
        document.getElementById('emailError').textContent = 'Please enter a valid email address.';
        isValid = false;
    }


    if (!country || country === ' ') {
        document.getElementById('nameError').textContent = 'Name is required.';
        isValid = false;
    } else if (!nameRegex.test(country)) {
        document.getElementById('nameError').textContent = 'Name must be 3-50 characters long and contain only letters and spaces.';
        isValid = false;
    }


    // Validate Phone
    if (!phone) {
        document.getElementById('phoneError').textContent = 'Phone number is required.';
        isValid = false;
    } else if (!phoneRegex.test(phone)) {
        document.getElementById('phoneError').textContent = 'Phone number must be 10-15 digits.';
        isValid = false;
    }


    if (!storeName || storeName === ' ') {
        document.getElementById('storeNameError').textContent = 'Store Name is required.';
        isValid = false;
    } else if (!textFieldRegex.test(storeName)) {
        document.getElementById('storeNameError').textContent = 'Store Name must be 2-50 characters long.';
        isValid = false;
    }

    // Validate Country
    if (!country || country === ' ') {
        document.getElementById('countryError').textContent = 'Country is required.';
        isValid = false;
    } else if (!textFieldRegex.test(country)) {
        document.getElementById('countryError').textContent = 'Country must be 2-50 characters long.';
        isValid = false;
    }

    // Validate Region
    if (!region || region === ' ') {
        document.getElementById('regionError').textContent = 'Region is required.';
        isValid = false;
    } else if (!textFieldRegex.test(region)) {
        document.getElementById('regionError').textContent = 'Region must be 2-50 characters long.';
        isValid = false;
    }

    // Validate City
    if (!city || city === ' ') {
        document.getElementById('cityError').textContent = 'City/Town is required.';
        isValid = false;
    } else if (!textFieldRegex.test(city)) {
        document.getElementById('cityError').textContent = 'City/Town must be 2-50 characters long.';
        isValid = false;
    }

    // Validate Logo
    if (logo) {
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        const maxSize = 2 * 1024 * 1024; // 2 MB

        if (!allowedTypes.includes(logo.type)) {
            document.getElementById('logoError').textContent = 'Only JPEG, PNG, and GIF files are allowed.';
            isValid = false;
        }

        if (logo.size > maxSize) {
            document.getElementById('logoError').textContent = 'File size must not exceed 2 MB.';
            isValid = false;
        }
    }

 
    if (!password || password === ' ') {
        document.getElementById('passwordError').textContent = 'Password is required.';
        isValid = false;
    } else if (password.length < 8 || !passwordRegex.test(password)) {
        document.getElementById('passwordError').textContent = 'Password must be at least 8 characters long.';
        isValid = false;
    }

    if (!confirmPassword || confirmPassword === ' ') {
        document.getElementById('confirmPasswordError').textContent = 'Confirm Password is required.';
        isValid = false;
    } else if (password !== confirmPassword) {
        document.getElementById('confirmPasswordError').textContent = 'Passwords do not match.';
        isValid = false;
    }

    
    if (isValid) {
        
        this.submit();
    }


});
