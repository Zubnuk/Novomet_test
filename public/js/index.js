document.addEventListener('DOMContentLoaded', () => {

    const forms = document.querySelectorAll('.needs-validation');

    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            
   
            if (!form.checkValidity()) {
                event.preventDefault();

                event.stopPropagation();
                
                console.warn(`Форма [${form.action}] содержит ошибки. Отправка отменена.`);
            } else {
                console.log(`Валидация формы [${form.action}] пройдена!`);
            
                const formData = new FormData(form);
                
             
                const dataObject = Object.fromEntries(formData.entries());
                
                console.table(dataObject);
            }

         
            form.classList.add('was-validated');
            
        }, false);
    });
});