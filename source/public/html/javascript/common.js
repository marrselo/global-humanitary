
function bookmark( url) {
var title='Global Humanitaria Perú';
 var url='http://www.globalhumanitariaperu.org';

    if(document.all) { // ie
        window.external.AddFavorite(url, title);
    }
    else if(window.sidebar) { // firefox
        window.sidebar.addPanel(title, url, "");
    }
    else if(window.opera && window.print) { // opera
        var elem = document.createElement('a');
        elem.setAttribute('href',url);
        elem.setAttribute('title',title);
        elem.setAttribute('rel','sidebar');
        elem.click(); // this.title=document.title;
    }
}