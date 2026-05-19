// FitSpace - Main JavaScript
document.addEventListener('DOMContentLoaded', () => {
    // 1. Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // 2. Filter Pills logic
    const filterPills = document.querySelectorAll('.filter-pill');
    filterPills.forEach(pill => {
        pill.addEventListener('click', () => {
            filterPills.forEach(p => p.classList.remove('active'));
            pill.classList.add('active');
            
            // Logic for filtering can be added here based on data attributes
            const filterValue = pill.textContent.trim().toLowerCase();
            console.log('Filtering by:', filterValue);
        });
    });

    // 3. Flash Message Auto-hide
    const flashMessages = document.querySelectorAll('.flash-message');
    flashMessages.forEach(msg => {
        setTimeout(() => {
            msg.style.opacity = '0';
            msg.style.transition = 'opacity 0.5s ease';
            setTimeout(() => msg.remove(), 500);
        }, 5000);
    });

    // 4. Dynamic Avatar initials (Optional enhancement)
    const avatars = document.querySelectorAll('.avatar');
    avatars.forEach(avatar => {
        const name = avatar.nextElementSibling?.querySelector('.name')?.textContent;
        if (name && avatar.textContent.trim() === '') {
            const initials = name.split(' ').map(n => n[0]).join('').toUpperCase();
            avatar.textContent = initials;
        }
    });
});