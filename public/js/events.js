/**
 * Função responsável por enviar os formulários via AJAX
 * 
 * @param {*} form 
 * @param {*} redirectTo 
 */
async function sendForm(form, redirectTo){
  
  const url = form.getAttribute('action');
  const data = new URLSearchParams(new FormData(form));

  fetch(form.getAttribute('action'), {
    method: 'POST',
    body: data
  }).then( res => {
    alert('Dados enviados com sucesso');
    window.location.hash = redirectTo;
  } );
}

/**
 * Função responsável por executar a busca
 * 
 * @param {*} evt 
 * @param {*} hash 
 */
async function search(evt, hash){
  if(evt.keyCode === 13) {
    console.log('enter')
    const word = evt.target.value;
    console.log(word)
    window.location.hash = `${hash}/${word}`;
  }
}