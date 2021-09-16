$(document).ready(function(){

    var url=location.href;
    
    if(url.indexOf("index.php")!=-1){
        $("#vote").click(vote)
    }
    if(url.indexOf("sign.php")!=-1){
        $("#login").click(login)
        $("#register").click(register)
    }
    if(url.indexOf("basket.php")!=-1){
        $("#order").click(order)
        $(".deleteFromBasket").click(removeFromBasket)
    }
    if(url.indexOf("product-details.php")!=-1){
        $("#add").click(basketAdd)
    }
    if(url.indexOf("contact.php")!=-1){
        $("#message").click(message)
    }
    if(url.indexOf("admintemplate")!=-1){
        $("#messages").click(getMessages)
        $("#users").click(getUsers)
        $("#survey").click(getSurvey)
        $("#orders").click(getOrders)
        $("#allProducts").click(allProducts)
        $("#allCategories").click(allCategories)
    }
})
function allCategories(e){
    e.preventDefault()
    $.ajax({
        url:'../../models/getCategoriesAdmin.php',
        method:"GET",
        dataType:"json",
        success:function(data){
            printCategories(data)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function printCategories(data){
    $("#title").html("Categories")
    var print=`<a href="#form" id="addCatForm">Add category</a>`
    print+=`<table class="table text-center"><tr><th>Image</th><th>Name</th><th>Update</th><th>Delete</th></tr>`
    for(let d of data){
        print+=`<tr><td><img src="../../assets/img/about/${d.img}" alt="${d.name}"/></td><td>${d.name}</td><td><a href="#" data-id="${d.idCategory}" class="updateCat">Update</a></td><td><a href="#" data-id="${d.idCategory}" class="deleteCat">Delete</a></td></tr>`
    }
    print+=`<table>`
    $("#forms").html("")
    $("#content").html(print)
    $("#addCatForm").click(formCategory)
    $(".deleteCat").click(deleteCat)
    $(".updateCat").click(updateCat)
}
function updateCat(e){
    e.preventDefault()
    var id=this.dataset.id
    $.ajax({
        url:'../../models/getCategori.php',
        method:"POST",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(data){
            formUpdateCategory(data)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function formUpdateCategory(data){
    var print=`<div class="col-12"><h2>Update category</h2></div>
    <div class="col-12">
        <form enctype="multipart/form-data">
           <label>  Name (required)</label>
            <input class="form-control" value="${data['name']}" name="nameCatUpdate" id="nameCatUpdate" type="text"/>    
           <label>  Image (required)</label>
            <input id="imageCatUpdate" type="file"/>
            <br><br>
            <input type="hidden" value="${data['idCategory']}" id="catId"/>
            <input type="button" class="btn btn-primary" id="updateCat" value="Update category"/>
        </form>
        <p id="err"></p>
        </div>
    `
    $("#forms").html(print)
    $("#updateCat").click(doUpdate)
}
function doUpdate(e){
    var id=$("#catId").val()
    var img=$("#imageCatUpdate")[0].files[0]
    var name=$("#nameCatUpdate").val()

    
    var podaciZaSlanje=new FormData()

    podaciZaSlanje.append("name",name)
    podaciZaSlanje.append("image",img)
    podaciZaSlanje.append("id",id)
    $.ajax({
        url:'../../models/updateCategory.php',
        method:"POST",
        processData:false,
        contentType:false,
        data:podaciZaSlanje,
        success:function(data){
            if(JSON.parse(data)=="Category updated"){
                allCategories(e)
                $("#err").html(data)
            }
            else{
                $("#err").html(data)
            }
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function deleteCat(e){
    e.preventDefault()
    var id=this.dataset.id
    $.ajax({
        url:'../../models/deleteCat.php',
        method:"POST",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(data){
            allCategories(e)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function formCategory(e){
    e.preventDefault()
    var print=`<div class="col-12"><h2>Add category</h2></div>
    <div class="col-12">
        <form enctype="multipart/form-data">
           <label>  Name (required)</label>
            <input class="form-control" name="nameCat" id="nameCat" type="text"/>    
           <label>  Image (required)</label>
            <input id="imageCat" type="file"/>
            <br><br>
            <input type="button" class="btn btn-primary" id="addCat" value="Add category"/>
        </form>
        <p id="err"></p>
        </div>
    `
    $("#forms").html(print)
    $("#addCat").click(addCat)
}
function addCat(e){
    var name=$("#nameCat").val()
    var img=$("#imageCat")[0].files[0]

    
    var podaciZaSlanje=new FormData()

    podaciZaSlanje.append("name",name)
    podaciZaSlanje.append("image",img)
    $.ajax({
        url:'../../models/insertCategoru.php',
        method:"POST",
        processData:false,
        contentType:false,
        data:podaciZaSlanje,
        success:function(data){
            if(JSON.parse(data)=="Category added"){
                allCategories(e)
                $("#err").html(data)
            }
            else{
                $("#err").html(data)
            }
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function allProducts(e){
    e.preventDefault()
    $.ajax({
        url:'../../models/getProductsAdmin.php',
        method:"GET",
        dataType:"json",
        success:function(data){
            printProducts(data)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function printProducts(data){
    $("#title").html("Products")
    var print=`<a href="#form" id="addProductForm">Add product</a>`
    print+=`<table class="table text-center"><tr><th>Image</th><th>Title</th><th>Price</th><th>Update</th><th>Delete</th></tr>`
    for(let d of data){
        print+=`<tr><td><img src="../../assets/img/product/${d.img}" alt="${d.name}"/></td><td>${d.name}</td><td>${d.price}</td><td><a href="#" data-id="${d.idProduct}" class="updateProduct">Update</a></td><td><a href="#" data-id="${d.idProduct}" class="deleteProduct">Delete</a></td></tr>`
    }
    print+=`<table>`

    $("#forms").html("")
    $("#content").html(print)
    $("#addProductForm").click(productForm)
    $(".updateProduct").click(updateProduct)
    $(".deleteProduct").click(deleteProduct)
}
function deleteProduct(e){
    e.preventDefault()
    var id=this.dataset.id
    $.ajax({
        url:'../../models/deleteProduct.php',
        method:"POST",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(data){
            allProducts(e)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function updateProduct(e){
    e.preventDefault()
    var id=this.dataset.id
    $.ajax({
        url:'../../models/getProductUpdate.php',
        method:"GET",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(data){
            formUpdateProduct(data)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function formUpdateProduct(data){
    var print=`<div class="col-12"><h2>Edit product</h2></div>
    <div class="col-12">
        <form enctype="multipart/form-data">
           <label>  Name (required)</label>
            <input class="form-control" name="titleUpdate" value="${data['name']}" id="titleUpdate" type="text"/>  
           <label>  Price (required)</label>
            <input class="form-control" name="priceUpdate" id="priceUpdate" value="${data['price']}" type="text"/>
        <div class="contact_textarea">
            <label>  Description</label>
            <textarea name="descriptionUpdate"  class="form-control" id="descriptionUpdate">${data['description']}</textarea> 
            <input type="hidden" id="productId" value="${data['idProduct']}"/>
            <input type="hidden" id="oldPrice" value="${data['price']}"/>
        </div>     
           <label>  Image (required)</label>
            <input id="imageUpdate" type="file"/>
            <br><br>
            <input type="button" class="btn btn-primary" id="edit" value="Edit product"/>
        </form>
        <p id="err"></p>
        </div>
    `
    $("#forms").html(print)
    $("#edit").click(editProduct)
}
function editProduct(e){
    var name=$("#titleUpdate").val()
    var price=$("#priceUpdate").val()
    var description=$("#descriptionUpdate").val()
    var image=$("#imageUpdate")[0].files[0];
    var id=$("#productId").val()
    var oldPrice=$("#oldPrice").val()

    var podaciZaSlanje=new FormData();

    podaciZaSlanje.append("name",name)
    podaciZaSlanje.append("price",price)
    podaciZaSlanje.append("descripion",description)
    podaciZaSlanje.append("image",image)
    podaciZaSlanje.append("id",id)
    podaciZaSlanje.append("oldPrice",oldPrice)
    $.ajax({
        url:'../../models/editProduct.php',
        method:"POST",
        processData:false,
        contentType:false,
        data:podaciZaSlanje,
        success:function(data){
            if(JSON.parse(data)=="Product successfully updated"){
                allProducts(e)
                $("#err").html(JSON.parse(data))
            }
            else{
                $("#err").html(data)
            }
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function productForm(e){
    e.preventDefault()
    var print=`<div class="col-12"><h2>Add product</h2></div>
    <div class="col-12">
        <form enctype="multipart/form-data">
           <label>  Name (required)</label>
            <input class="form-control" name="titleAdd" id="titleAdd" type="text"/>  
           <label>  Price (required)</label>
            <input class="form-control" name="priceAdd" id="priceAdd" type="text"/>
        <div class="contact_textarea">
            <label>  Description</label>
            <textarea name="descriptionAdd"  class="form-control" id="descriptionAdd"></textarea> 
        </div>     
           <label>  Image (required)</label>
            <input id="imageAdd" type="file"/>
            <br><br>
            <input type="button" class="btn btn-primary" id="add" value="Add product"/>
        </form>
        <p id="err"></p>
        </div>
    `
    $("#forms").html(print)
    $("#add").click(addProduct)
}
function addProduct(e){
    var name=$("#titleAdd").val()
    var price=$("#priceAdd").val()
    var description=$("#descriptionAdd").val()
    var image=$("#imageAdd")[0].files[0];

    var podaciZaSlanje=new FormData();

    podaciZaSlanje.append("name",name)
    podaciZaSlanje.append("price",price)
    podaciZaSlanje.append("descripion",description)
    podaciZaSlanje.append("image",image)
    $.ajax({
        url:'../../models/addProduct.php',
        method:"POST",
        processData:false,
        contentType:false,
        data:podaciZaSlanje,
        success:function(data){
            if(JSON.parse(data)=="Product successfully added"){
                allProducts(e)
                $("#err").html(JSON.parse(data))
            }
            else{
                $("#err").html(data)
            }
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })

}
function getOrders(e){
    e.preventDefault()
    $.ajax({
        url:'../../models/getOrders.php',
        method:"GET",
        dataType:"json",
        success:function(data){
            printOrders(data)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function printOrders(data){
    $("#title").html("Orders")
    var print=`<table class="table text-center"><tr><th>Name</th><th>E-mail</th><th>Adress</th><th>Product</th><th>Quantity</th><th>Size</th><th>Processed</th></tr>`
    for(let d of data){
        print+=`<tr><td>${d.name} ${d.lastName}</td><td>${d.email}</td><td>${d.adress}</td><td>${d.pName}</td><td>${d.quantity}</td><td>${d.size}</td><td><a href="#" data-id="${d.idOrder}" class="order">Processed</a></td></tr>`
    }
    print+=`<table>`

    $("#forms").html("")
    $("#content").html(print)
    $(".order").click(processed)
}
function processed(e){
    e.preventDefault()
    var id=this.dataset.id
    
    $.ajax({
        url:'../../models/removeFromBasket.php',
        method:"POST",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(data){
            getOrders(e)
        },
        error:function(xhr){
            $("#content").html(`<h2>${JSON.parse(xhr.responseText)}</h2>`)
        }
    })
}
function getSurvey(e){
    e.preventDefault()
    $.ajax({
        url:'../../models/getSurveyResult.php',
        method:"GET",
        dataType:"json",
        success:function(data){
            printResult(data)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function printResult(data){
    $("#title").html("Survey")

    var print=`<h2>${data['pitanje']}</h2>`
    for(let o of data['odgovori']){
        print+=`<p>${o.answer} : ${o.broj}%</p>`
    }

    if(data['aktivna']==1){
        print+=`<a href="#" id="disable">Disable</a>`
    }
    else{
        print+=`<a href="#" id="enable">Enable</a>`
    }
    $("#content").html(print)

    $("#forms").html("")
    $("#enable").click(enable)
    $("#disable").click(disable)
    
}
function enable(e){
    e.preventDefault()
    $.ajax({
        url:'../../models/enable.php',
        method:"GET",
        dataType:"json",
        data:{
        },
        success:function(data){
            getSurvey(e)
        },
        error:function(xhr){
            $("#content").html(`<h2>${JSON.parse(xhr.responseText)}</h2>`)
        }
    })
}
function disable(e){
    e.preventDefault()
    $.ajax({
        url:'../../models/disable.php',
        method:"GET",
        dataType:"json",
        data:{
        },
        success:function(data){
            getSurvey(e)
        },
        error:function(xhr){
            $("#content").html(`<h2>${JSON.parse(xhr.responseText)}</h2>`)
        }
    })
}
function getUsers(e){
    e.preventDefault()
    $.ajax({
        url:'../../models/getUsers.php',
        method:"GET",
        dataType:"json",
        success:function(data){
            printUsers(data)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function printUsers(data){
    $("#title").html("Users")
    var print=`<table class="table text-center"><tr><th>Name</th><th>E-mail</th></tr>`
    for(let d of data){
        print+=`<tr><td>${d.name} ${d.lastName}</td><td>${d.email}</td></tr>`
    }
    print+=`<table>`

    $("#forms").html("")
    $("#content").html(print)
}
function getMessages(e){
    e.preventDefault()
    $.ajax({
        url:'../../models/getMessages.php',
        method:"GET",
        dataType:"json",
        success:function(data){
            printMessages(data)
        },
        error:function(xhr){
            $("#content").html(JSON.parse(xhr.responseText))
        }
    })
}
function printMessages(data){
    $("#title").html("Messages")
    var print=`<table class="table text-center"><tr><th>E-mail</th><th>Subject</th><th>Text</th><th>Delete</th></tr>`
    for(let d of data){
        print+=`<tr><td>${d.email}</td><td>${d.subject}</td><td>${d.text}</td><th><a href="#" class="deleteMessage" data-id="${d.idMessage}">Delete</a></th></tr>`
    }
    print+=`<table>`

    $("#content").html(print)
    $("#forms").html("")
    $(".deleteMessage").click(deleteMessage)
}
function deleteMessage(e){
    e.preventDefault()
    var id=this.dataset.id
    
    $.ajax({
        url:'../../models/deleteMessage.php',
        method:"POST",
        dataType:"json",
        data:{
            "id":id
        },
        success:function(data){
            getMessages(e)
        },
        error:function(xhr){
            $("#content").html(`<h2>${JSON.parse(xhr.responseText)}</h2>`)
        }
    })
}
function message(){
    var email=$("#email").val()
    var subject=$("#subject").val()
    var message=$("#text").val()

    var regEmail=/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;
    var regNaslov=/^[\w\s]+$/;

    if(!regEmail.test(email)){
        $("#errorMessage").html("E-mail formats: pera@gmail.com or petar.petrovic@ict.edu.rs");
        return false;
    }
    else{
        $("#errorMessage").html("")
    }
    if(!regNaslov.test(subject)){
        $("#errorMessage").html("You have to write subject");
        return false;
    }
    else{
        $("#errorMessage").html("")
    }
    message=message.split(" ")
    if(message.length<10){
        $("#errorMessage").html("Message mus have 10 words minimum");
        return false;
    }
    else{
        $("#errorMessage").html("")
    }
        $.ajax({
            url:'models/message.php',
            method:"POST",
            dataType:"json",
            data:{
                "email":email,
                "message":message,
                "subject":subject,
                "btnMessage":true
            },
            success:function(data){
                $("#errorMessage").html(data)
                $("input[type='text']").val("")
                $("input[type='email']").val("")
                $("textarea").val("")

            },
            error:function(xhr){
                $("#errorMessage").html(JSON.parse(xhr.responseText))
            }
        })
}
function vote(){
    var idAnswer=$("input[name='answer']:checked").val()
    if(!idAnswer){
        $("#answerError").html("You have to choose answer")
    }
    else{
        $.ajax({
            url:'models/vote.php',
            method:"POST",
            dataType:"json",
            data:{
                "id":idAnswer,
            },
            success:function(data){
                $("#answerError").html(data)
                $("#vote").attr("disabled",true)
                $("#vote").addClass("disabled")
            },
            error:function(xhr){
                $("#answerError").html(JSON.parse(xhr.responseText))
            }
        })
    }
}
function removeFromBasket(e){
    e.preventDefault()
    var id=this.dataset.id
    $.ajax({
        url:'models/removeFromBasket.php',
        method:"POST",
        dataType:"json",
        data:{
            "id":id,
        },
        success:function(data){
            location.reload()
        },
        error:function(xhr){
            $("#errorBasket").html(JSON.parse(xhr.responseText))
        }
    })
}
function basketAdd(){
    var productId=$("#productId").val()
    var priceId=$("#price").val()
    var quantity=$("#quantity").val()
    var size=$("#size").val()

    if(size==0){
        $("#errorAdd").html("You have to choose size");
    }
    else{
    
        $.ajax({
            url:'models/addCard.php',
            method:"POST",
            dataType:"json",
            data:{
                "idProduct":productId,
                "idPrice":priceId,
                "quantity":quantity,
                "size":size
            },
            success:function(data){
                $("#errorAdd").html(data)
            },
            error:function(xhr){
                $("#errorAdd").html(JSON.parse(xhr.responseText))
            }
        })
    }
}
function order(){
    var address=$("#address").val()

    var regAdress=/^[A-Z][a-z]+(\s[A-z]+)*\s[\d]+$/

    
    if(!regAdress.test(address)){
        $("#errorBasket").html("Address has minimum one word with capital letter and number. eg. Princess Road 55")
        return false
    }
    else{
        $("#errorBasket").html("")
    }

    $.ajax({
        url:'models/order.php',
        method:"POST",
        dataType:"json",
        data:{
            "address":address
        },
        success:function(data){
            $("#message").html(data)
            $("#tabela").html('')
            $("#total").html('')
        },
        error:function(xhr){
            $("#errorBasket").html(JSON.parse(xhr.responseText))
        }
    })

}
function register(){
    var fName=$("#firstName").val()
    var lName=$("#lastName").val()
    var email=$("#emailReg").val()
    var phone=$("#phone").val()
    var password=$("#passwordReg").val()
    
    

    var regName=/^[A-ZŠĐŽČĆ][a-zšđžčć]{2,19}$/
    var regPhone=/^06\d{1}\/\d{7}$/
    var regEmail=/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;
    var regPass=/^.{8,50}$/;
    
    if(!regName.test(fName)){
        $("#errorsRegister").html("First name has capital letter, 3 letter min, 20 max.")
        return false
    }
    else{
        $("#errorsRegister").html("")
    }
    
    if(!regName.test(lName)){
        $("#errorsRegister").html("Last name has capital letter, 3 letter min, 20 max.")
        return false
    }
    else{
        $("#errorsRegister").html("")
    }

    
    
    if(!regPhone.test(phone)){
        $("#errorsRegister").html("Phone format: 060/1234567.")
        return false
    }
    else{
        $("#errorsRegister").html("")
    }

    
    if(!regEmail.test(email)){
        $("#errorsRegister").html("E-mail formats: pera@gmail.com or petar.petrovic@ict.edu.rs")
        return false
    }
    else{
        $("#errorsRegister").html("")
    }
    if(!regPass.test(password)){
        $("#errorsRegister").html("Password must be at least 8 characters long")
        return false
    }
    else{
        $("#errorsRegister").html("")
    }



    $.ajax({
        url:'models/login.php',
        method:"POST",
        dataType:"json",
        data:{
            "btnReg":true,
            "firstName":fName,
            "lastName":lName,
            "email":email,
            "password":password,
            "phone":phone
        },
        success:function(data){
            if(data=="userName"){
                $("#errorsRegister").html("E-mail is already in use")
            }
            else{
                $("#errorsRegister").html(data)
            }
        },
        error:function(xhr){
            $("#errorsRegister").html(JSON.parse(xhr.responseText))
        }
    })
}
function login(){
    var email=$("#email").val()
    var password=$("#password").val()

    
    
    var regEmail=/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;
    var regPass=/^.{8,50}$/;

    
    if(!regEmail.test(email)){
        $("#errorsLogin").html("E-mail formats: pera@gmail.com or petar.petrovic@ict.edu.rs")
        return false
    }
    else{
        $("#errorsLogin").html("")
    }
    if(!regPass.test(password)){
        $("#errorsLogin").html("Password must be at least 8 characters long")
        return false
    }
    else{
        $("#errorsLogin").html("")
    }
    
    $.ajax({
        url:'models/login.php',
        method:"POST",
        dataType:"json",
        data:{
            "email":email,
            "password":password,
            "btnLog":true
        },
        success:function(data){
            if(data=="ok"){
                location.href="index.php"
            }
            else{
                $("#errorsLogin").html(data)
            }
        },
        error:function(xhr){
            $("#errorsLogin").html(JSON.parse(xhr.responseText))
        }
    })
}