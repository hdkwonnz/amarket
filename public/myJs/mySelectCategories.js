
function selectCategoryA() {
    $.ajax({
        type: 'POST',
        url: '/products/selectCategoryA',
        data: {},
        cache: false,
        async: false,
        success: function (data) {
            $('#categoryDetails').empty().append(data);
        },
        error: function (data) {
            alert('시스템에러...categoryA')
        }
    });
}

function selectCategoryB(categoryAid, categoryAname)
{
    //debugger;
    $.ajax({
        type: 'POST',
        url: '/products/selectCategoryB',
        data: { id: categoryAid, name: categoryAname },
        cache: false,
        async: false,
        success: function (data) {              
            $('#categoryDetails').empty().append(data);              
        },
        error: function (data) {
            alert("시스템에러...categoryB")                            
        }
    });
}


function selectCategoryC(categoryAid, categoryBid, categoryAName, categoryBName) {
    $.ajax({
        type: 'POST',
        url: '/products/selectCategoryC',
        data: { id: categoryAid, id2: categoryBid, name: categoryAName, name2: categoryBName },
        cache: false,
        async: false,
        success: function (data) {
            $('#categoryDetails').empty().append(data);
        },
        error: function (data) {
            alert('시스템에러...categoryC')
        }
    });
}


function selectCategoryD(categoryAid, categoryBid, categoryCid, categoryAName, categoryBName, categoryCName) {
   
    $.ajax({
        type: 'POST',
        url: '/products/selectCategoryD',
        data: { id: categoryAid, id2: categoryBid, id3: categoryCid, name: categoryAName, name2: categoryBName, name3: categoryCName, },
        cache: false,
        async: false,
        success: function (data) {
            $('#categoryDetails').empty().append(data);
        },
        error: function (data) {
            alert('시스템에러...categoryD')
        }
    });
}


function inputProducts(categoryAid, categoryBid, categoryCid, categoryDid,
                                    categoryAName, categoryBName, categoryCName, categoryDName) {

    $.ajax({
        type: 'POST',
        url: '/products/inputProducts',
        data: {
            id: categoryAid, id2: categoryBid, id3: categoryCid, id4: categoryDid,
            name: categoryAName, name2: categoryBName, name3: categoryCName, name4: categoryDName
        },
        //debugger;
        cache: false,
        async: false,
        success: function (data) {
            //alert(data);
            $('#categoryDetails').empty().append(data);
        },
        error: function (data) {
            alert('시스템에러...inputProducts...')
        }
    });

    ////아래방법으로 하면 새로운 창이뜬다...
    ////window.open('/products/inputProducts?id=' + categoryAid + '&id2=' + categoryBid + '&id3=' + categoryCid + '&id4=' + categoryDid, 'NewWindow');
    ////아래방법으로 하면 원하는 주소로 이동한다...
    //window.location.href = '/products/inputProducts?id=' + categoryAid + '&id2=' + categoryBid + '&id3=' + categoryCid + '&id4=' + categoryDid;
}