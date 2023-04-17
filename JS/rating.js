

$(document).ready(function(){
    var url = window.location.href;
    if (url.indexOf("detail") == 52){
        console.log(url.indexOf("detail"));
        let product_id = url.slice(62);
        let get_url = make_get_url("readAverageRating", product_id);
        $.getJSON(get_url, function(data){
            set_rating("#rating_star_",data["avg"]);
    })
    }
    ;
    
});


function set_rating(rating_id,avg){
    avg = Math.round(avg);
    for (let i = 1; i <= 5; i++) {
        if (avg >= i){
            $(rating_id + i).text("★");
        } else {
            $(rating_id + i).text("☆");
        }
    }
}

function make_get_url(func, product_id=0, user_id=0){
    let get_url = "https://localhost/educom-webshop-oop/index.php?action=ajax";
    get_url = get_url + "&function=" + func;
    if (product_id != 0){
        get_url = get_url + "&product_id=" + product_id;
    }
    if (user_id != 0){
        get_url = get_url + "&user_id=" + product_id;
    }
    return get_url;
}



/*☆★*/