window.onload = function() {
  if (window.location.href('/search/cars')) {
  }else{
  if (window.location.href('/used-cars/automatics')) {     
  }
    //Hide the element.
    document.querySelectorAll('#refine')[0].style.display = 'none';
  }
};