

window.onload = function() {
        //kontrollin, kas tegemist on galeriilehega

        if (document.getElementById("hoidja") != 0  ) {
            var piltideKogum = document.getElementById("pildid").getElementsByTagName("img");  //hangin kõik pildid
            for (var i = 0; i < piltideKogum.length; i++) {
                piltideKogum[i].onclick = function() {  //pildi klikkimisel jooksutan showDetails()
                    showDetails(this);
                    return false;
                }
            }
    }

    function showDetails(el) {
        if (document.getElementById("hoidja") != 0) { //kontrollin kas "hoidja" on olemas
            suurPilt = document.getElementById("suurpilt"); //võtan "suurpilt" id-ga pildi
            suurPilt.src = el.parentNode.href;
            suurPilt.onload = function() {
                suurus(this);
            }
            inf = document.getElementById("inf");
            inf.innerHTML = el.alt;
            document.getElementById("hoidja").style.display = "initial";
        }
    }

    function suurus(el){
        el.removeAttribute("height"); // eemaldab suuruse
        el.removeAttribute("width");
        if (el.width>window.innerWidth || el.height>window.innerHeight){  // ainult liiga suure pildi korral
            if (window.innerWidth >= window.innerHeight){ // lai aken
                el.height=window.innerHeight*0.9; // 90% kõrgune
                if (el.width>window.innerWidth){ // kas element läheb ikka üle piiri?
                    el.removeAttribute("height");
                    el.width=window.innerWidth*0.9;
                }
            } else { // kitsas aken
                el.width=window.innerWidth*0.9;   // 90% laiune
                if (el.height>window.innerHeight){ // kas element läheb ikka üle piiri?
                    el.removeAttribute("width");
                    el.height=window.innerHeight*0.9;
                }
            }
        }
    }

    function hideDetails(el) {
        document.getElementById("hoidja").style.display = "none";

    }

    window.onresize=function() {
        suurpilt=document.getElementById("suurpilt");
        suurus(suurpilt);
    }

}
