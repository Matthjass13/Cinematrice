function toggleElement(elementID) {
  $('#' + elementID).fadeToggle();
}
// Dévoiler / cacher le podcast et de ses parties lors de son affichage

function showConfirmation() {
    var result = confirm("Êtes-vous sûr de vouloir effacer cet élément ?");
    return result;
}
// Pop up de confirmation avant la suppression d'un contenu