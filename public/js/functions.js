// Function reloads an element of the page
function refresh(element) {
    $(element).load(document.URL+' '+element+'>*');
    return true;
}