

document.addEventListener('DOMContentLoaded', () => {
   
    const allDeleteForms = document.querySelectorAll('.delete-form');


    allDeleteForms.forEach(form => {

        form.addEventListener('submit', function(event) {
            
     
            const confirmed = confirm('Ты уверен, что хочешь удалить эту запись?');

       
            if (!confirmed) {
               
                event.preventDefault();
            }
        });
    });
});