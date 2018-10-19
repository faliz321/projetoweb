/**
 * Sempre que for executada, esta função verifica se existe um hash na url e 
 * carrega o arquivo correto para a rota definida
 */
const loadPage = () => {
  loading();
  // Elemento main da página principal, onde os dados serão carregados
  const mainElement = document.querySelector('main');
  // Variável que contém a url do arquivo que deve ser carregado para a rota atual
  const { url } = mapper();

  // Pego a página via AJAX
  fetch( url ).then( response => {
    if ( response.ok ) {
      response.text().then( r => {
        mainElement.innerHTML = r;
      })
    } else {
      console.log( 'Erro simples', response );
    }

  } ).catch( err => {
    console.log( 'Erro fatal', err );
  })
}


/**
 * Regista o evento ao alterar o hash da url
 */
window.onhashchange =  e => {
  loadPage();
}

/**
 * Exibe um "carregando" na página, chamado sempre que for acontecer um
 * carregamento de uma nova página
 */
const loading = () => {
  const mainElement = document.querySelector('main');
  mainElement.innerHTML = '<div class="loading">Carregando...</div>'
}

/**
 * Quebra o hash da url seguindo os padrão abaixo e devolve seus componentes
 * 
 * #acervo
 * #acervo/add
 * #acervo/edit/3
 * #acervo/search/termos+da+pesquisa
 */
const mapper = () => {
  let object = {};
  if ( window.location.hash ) {
    // Quebra o hash pela / e remove o '#' do início
    const parts = window.location.hash.substr(1).split('/');

    // Verifica se possui 1, 2 ou 3 pedaços
    switch( parts.length ) {
      case 1: 
        object = { controller: parts[0], action: 'index', hasId: false };
        object.url = `pages/${object.controller}/${object.action}.php`;
        break;

      case 2: 
        object = { controller: parts[0], action: parts[1] ? parts[1] : 'index', hasId: false };
        object.url = `pages/${object.controller}/${object.action}.php`;
        break;

      case 3: 
        object = { controller: parts[0], action: parts[1], query: parts[2], hasId: false };
        
        if ( object.action === 'search' ) {
          object.url = `pages/${object.controller}/index.php?q=${object.query}`;
        } else {
          object.hasId = true;
          object.url = `pages/${object.controller}/${object.action}.php?id=${object.query}`;
        }

        break;
    }

    return object;
  } else {
    // Caso não tenha hash, devolve a página principal
    return { controller: 'acervo', action: 'index', hasId: false, url: 'pages/acervo/index.php' };
  }
}

/**
 * Inicia o carregamento da página
 */
loadPage();