

$(document).ready(function(){
    var url = window.location.href;
    if (url.includes("detail")){
        let product_id = url.slice(url.indexOf("detail") + 10);
        set_rating_detail(product_id);
        
        $.getJSON(make_get_url("readUserRating", product_id), function(data){
            let user_rating = data["rating"];
            set_rating("#rating_star_user_",user_rating); 

        
            for (let i = 1; i <= 5; i++) {
        
                $("#rating_star_user_" + i).mouseenter(function(){
                    set_rating("#rating_star_user_",i);
                    });
            
                $("#rating_star_user_" + i).mouseleave(function(){
                    set_rating("#rating_star_user_",user_rating);
                    });
        
                $("#rating_star_user_" + i).click(function(){
        
                    if (user_rating == 0){
                        get_url = make_get_url("createRating", product_id, i);
                    } else {
                        get_url = make_get_url("updateRating", product_id, i);
                    }
                    user_rating = i;
                    set_rating("#rating_star_user_",user_rating);
                    $.get(get_url)
                    set_rating_detail(product_id);
                    });
            }
        });
    } else if (url.includes("=webshop")){
        let get_url = make_get_url("readAverageRatingAll");
        $.getJSON(get_url, function(data){
            set_rating_webshop(data);
        })
    };

});


function set_rating(rating_id,limit){
    limit = Math.round(limit);
    for (let i = 1; i <= 5; i++) {
        if (limit >= i){
            $(rating_id + i).text("★");
        } else {
            $(rating_id + i).text("☆");
        }
    }
}

function set_rating_detail(product_id){
    $.getJSON(make_get_url("readAverageRating", product_id), function(data){
        set_rating("#rating_star_",data["avg"]);
    })
}

function set_rating_webshop(data){
    data.forEach(function(value){
        console.log("#rating_star_product_" + value["product_id"] + "_" + value["avg"]);
        set_rating("#rating_star_product_" + value["product_id"] + "_" , value["avg"])
    });
}

function make_get_url(func, product_id=0, rating=0){
    let get_url = "https://localhost/educom-webshop-oop/index.php?action=ajax";
    get_url = get_url + "&function=" + func;
    if (product_id != 0){
        get_url = get_url + "&product_id=" + product_id;
    }
    if (rating != 0){
        get_url = get_url + "&rating=" + rating;
    }
    return get_url;
}



/*☆★*/