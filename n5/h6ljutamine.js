/**
 * Created by Aet on 20.03.2016.
 */
window.onload = function() {

    var beads = document.querySelectorAll(".bead");
    for(i=0; i< beads.length; i++){
        beads[i].onclick = function() {
            var floatStyleValue = getComputedStyle(this).getPropertyValue("float")
            if (floatStyleValue == "left") {
                this.style.cssFloat = "right" ;
            } else{
                this.style.cssFloat = "left"
            }
        }

    }
}