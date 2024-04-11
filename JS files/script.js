document.addEventListener('DOMContentLoaded', function() {
  var container = document.querySelector('.cards-frame');
  var cards = document.querySelectorAll('.card');
  var containerWidth = cardWidth * 3; // Afișează doar trei carduri

  container.style.width = containerWidth + 'px';
});
