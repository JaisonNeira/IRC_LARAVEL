const files = document.querySelectorAll('.irc-input-file');
Array.from(files).forEach(
    f => {
        f.addEventListener('change', e => {
           const span = document.querySelector('.irc-input-file_nombre > span');
            if( f.files.length == 0 ){
                span.innerHTML = f.dataset.empty ||'Ningún archivo seleccionado';
            }else{
                span.innerHTML = f.files[0].name;
            }
        } );   
    }
);