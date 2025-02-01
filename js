document.addEventListener('DOMContentLoaded', function () {
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    const featureCards = document.querySelectorAll('.feature-card');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, {
        threshold: 0.1
    });

    featureCards.forEach(card => {
        observer.observe(card);
    });
});

document.getElementById('loginForm').addEventListener('submit', function (e) {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (!email || !password) {
        e.preventDefault();
        alert('Please fill in all fields.');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const authContainer = document.querySelector('.auth-container');
    authContainer.style.opacity = '0';
    authContainer.style.transform = 'translateY(20px)';

    setTimeout(() => {
        authContainer.style.opacity = '1';
        authContainer.style.transform = 'translateY(0)';
        authContainer.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    }, 100);
});

document.getElementById('signupForm').addEventListener('submit', function (e) {
    const name = document.getElementById('name').value;
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (!name || !username || !email || !password || !confirmPassword) {
        e.preventDefault();
        alert('Please fill in all fields.');
    } else if (password !== confirmPassword) {
        e.preventDefault();
        alert('Passwords do not match.');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const authContainer = document.querySelector('.auth-container');
    authContainer.style.opacity = '0';
    authContainer.style.transform = 'translateY(20px)';

    setTimeout(() => {
        authContainer.style.opacity = '1';
        authContainer.style.transform = 'translateY(0)';
        authContainer.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    }, 100);
});

document.addEventListener('DOMContentLoaded', function () {
    const plantCards = document.querySelectorAll('.plant-card');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, {
        threshold: 0.1
    });

    plantCards.forEach(card => {
        observer.observe(card);
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(tc => tc.classList.remove('active'));

            this.classList.add('active');
            const targetTab = this.getAttribute('data-tab');
            document.getElementById(targetTab).classList.add('active');
        });
    });
});


document.getElementById('profileForm').addEventListener('submit', function (e) {
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (newPassword !== confirmPassword) {
        e.preventDefault();
        alert('Passwords do not match.');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const plantCards = document.querySelectorAll('.plant-card');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, {
        threshold: 0.1
    });

    plantCards.forEach(card => {
        observer.observe(card);
    });
});

document.getElementById('addPlantForm').addEventListener('submit', function (e) {
    const plantName = document.getElementById('plantName').value;
    const classification = document.getElementById('classification').value;
    const region = document.getElementById('region').value;
    const description = document.getElementById('description').value;
    const benefits = document.getElementById('benefits').value;
    const usageMethods = document.getElementById('usageMethods').value;
    const warnings = document.getElementById('warnings').value;

    if (!plantName || !classification || !region || !description || !benefits || !usageMethods || !warnings) {
        e.preventDefault();
        alert('Please fill in all fields.');
    }
});

document.getElementById('editPlantForm').addEventListener('submit', function (e) {
    const plantName = document.getElementById('plantName').value;
    const classification = document.getElementById('classification').value;
    const region = document.getElementById('region').value;
    const description = document.getElementById('description').value;
    const benefits = document.getElementById('benefits').value;
    const usageMethods = document.getElementById('usageMethods').value;
    const warnings = document.getElementById('warnings').value;

    if (!plantName || !classification || !region || !description || !benefits || !usageMethods || !warnings) {
        e.preventDefault();
        alert('Please fill in all fields.');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const userCards = document.querySelectorAll('.user-card');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, {
        threshold: 0.1
    });

    userCards.forEach(card => {
        observer.observe(card);
    });
});

document.getElementById('editUserForm').addEventListener('submit', function (e) {
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (newPassword !== confirmPassword) {
        e.preventDefault();
        alert('Passwords do not match.');
    }
});


document.addEventListener('DOMContentLoaded', function () {
    const statCards = document.querySelectorAll('.stat-card');
    const linkCards = document.querySelectorAll('.link-card');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, {
        threshold: 0.1
    });

    statCards.forEach(card => {
        observer.observe(card);
    });

    linkCards.forEach(card => {
        observer.observe(card);
    });
});
