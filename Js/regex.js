const inputs = document.querySelectorAll("input");

const patterns = {
    telephone0: /^(?=.{5,20}$)[0-9+\- ]+$/,
    telephone1: /^(?=.{5,20}$)[0-9+\- ]+$/,
    mail0: /^[\w\.-]+@[\w\.-]+\.\w+$/,
    mail1: /^[\w\.-]+@[\w\.-]+\.\w+$/
}

/**
 * Check if the param correspond in his proper give regex
 * @param {*} field 
 * @param {*} regex 
 */
function checking(field, regex){
    if(is_date(field)){
        is_valid_date(field);
    }
    else{
        if(regex.test(field.value) && field.value != ''){
            field.className='valid';
        }
        else{
            field.className='invalid';
        }
    }
}


inputs.forEach((input) =>{
    input.addEventListener("input", (e) =>{
        let rem = '[]';
        let name = e.target.getAttribute("name");
        name = name.replace(rem, '');
        checking(e.target, patterns[name]);
    });
});


/**
 * Check if the param is a data
 * @param {*} date 
 * @returns boolean, true if param is date otherwise false
 */
function is_date(date){
    let result = false;
    if(!isNaN(Date.parse(date.value))){
        result = true;
    }
    return result;
}

/**
 * Check if the date inputed do not exceed today date, if so the input is not valid
 * @param {*} date 
 */
function is_valid_date(date){
    let daty = new Date(date.value);
    let current_date = new Date();
    if(daty >= current_date){
        date.className = "invalid";
    }
    else{
        date.className = "valid";
    }
}