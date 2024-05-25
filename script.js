document.addEventListener('DOMContentLoaded', () => {
    // Expandable images 

function setupImageOverlay(selector) {
    const expandables = document.querySelectorAll(selector);
    
        expandables.forEach(element => {
            element.addEventListener('click', function() {
                const imgSrc = this.querySelector('img').src; 
                const overlay = document.createElement('div');
                overlay.className = 'fullscreen-overlay';
                overlay.style.opacity = '0'; 
                overlay.style.transition = 'opacity 0.3s';
    
                const img = document.createElement('img');
                img.src = imgSrc;
                img.style.transform = 'scale(0)';
                img.style.transition = 'transform 0.5s';
    
                overlay.appendChild(img);
                document.body.appendChild(overlay);
    
                setTimeout(() => { 
                    overlay.style.opacity = '1';
                    img.style.transform = 'scale(1)';
                }, 200);
    
                overlay.addEventListener('click', function() {
                    this.style.opacity = '0';
                    img.style.transform = 'scale(0)';
                    setTimeout(() => {
                        document.body.removeChild(this);
                    }, 300);
                });
            });
        });
    }
    
    setupImageOverlay('.image-expandable');
});