function rand() {
    var inc = cadFuncionario.c.value; 
    inc += 1; 
    cadFuncionario.c.value = inc; 
    if(cadFuncionario.c.value > 1) { 
        cadFuncionario.botao.disabled;
    }else{
        document.getElementById("gera").innerHTML = Math.floor(Math.random() * 65536);
    }
}
function mascara(i,t){
    var v = i.value;

    if(isNaN(v[v.length-1])){
        i.value = v.substring(0, v.length-1);
        return;
    }

    if(t == "data"){
        i.setAttribute("maxlength", "10");
        if (v.length == 2 || v.length == 5) i.value += "/";
    }

    if(t == "cpf"){
        i.setAttribute("maxlength", "14");
        if (v.length == 3 || v.length == 7) i.value += ".";
        if (v.length == 11) i.value += "-";
    }

    if(t == "tel"){
        if(v.length == 7) i.value += "-";
    }

    if(t == "cnpj"){
        i.setAttribute("maxlength", "18");
        if (v.length == 2 || v.length == 6) i.value += ".";
        if (v.length == 10) i.value += "/";
        if (v.length == 15) i.value += "-";
    }
}

function onlyOne(checkbox) {
    var checkboxes = document.getElementsByName('check')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })
}