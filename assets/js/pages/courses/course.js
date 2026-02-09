document.addEventListener('DOMContentLoaded', function() {
    // Initialize all tooltips
    const tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltips.map(function (tooltipTrigger) {
        return new bootstrap.Tooltip(tooltipTrigger);
    });

    // Add click handlers for lesson resources
    const lessonResources = document.querySelectorAll('.lesson-resources li');
    lessonResources.forEach(resource => {
        resource.addEventListener('click', function(e) {
            // Add ripple effect
            const ripple = document.createElement('div');
            ripple.classList.add('ripple');
            this.appendChild(ripple);
            
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            
            setTimeout(() => ripple.remove(), 1000);

            // Show resource action feedback
            const resourceType = this.querySelector('i').classList.contains('fa-file-pdf') ? 'PDF' :
                               this.querySelector('i').classList.contains('fa-file-lines') ? 'ملخص' :
                               'تمارين';
            
            Swal.fire({
                title: 'جاري تحميل المحتوى',
                text: `جاري تحميل ${resourceType}...`,
                icon: 'info',
                timer: 1500,
                showConfirmButton: false,
                timerProgressBar: true
            });
        });
    });

    // Add progress tracking
    const accordionButtons = document.querySelectorAll('.nested-accordion .accordion-button');
    accordionButtons.forEach(button => {
        // Add completion checkbox
        const checkbox = document.createElement('div');
        checkbox.className = 'completion-check ms-2';
        checkbox.innerHTML = '<i class="fa-sharp fa-light fa-circle"></i>';
        button.insertBefore(checkbox, button.firstChild);

        button.addEventListener('click', function() {
            // Update progress when a lesson is opened
            if(this.classList.contains('collapsed')) {
                const checkbox = this.querySelector('.completion-check i');
                checkbox.className = 'fa-sharp fa-light fa-circle-check';
                
                // Update unit progress
                updateUnitProgress(this);
            }
        });
    });

    // Track video progress
    const videoContainer = document.querySelector('.video-container');
    if(videoContainer) {
        videoContainer.addEventListener('click', function() {
            Swal.fire({
                title: 'تشغيل الفيديو',
                text: 'هل تريد بدء مشاهدة الدرس؟',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'نعم',
                cancelButtonText: 'لا',
                confirmButtonColor: '#00A3B6'
            });
        });
    }

    // Function to update unit progress
    function updateUnitProgress(lessonButton) {
        const unit = lessonButton.closest('.accordion-item').parentElement.closest('.accordion-item');
        const totalLessons = unit.querySelectorAll('.nested-accordion .accordion-button').length;
        const completedLessons = unit.querySelectorAll('.completion-check .fa-circle-check').length;
        
        const progressBadge = unit.querySelector('.progress-badge');
        if(!progressBadge) {
            const badge = document.createElement('span');
            badge.className = 'badge bg-success progress-badge ms-2';
            badge.innerHTML = `${completedLessons}/${totalLessons}`;
            unit.querySelector('.accordion-button .badge').insertAdjacentElement('beforebegin', badge);
        } else {
            progressBadge.innerHTML = `${completedLessons}/${totalLessons}`;
        }
    }
});
