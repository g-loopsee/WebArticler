window.onload = function() {
    let middle_bar = $('.middle-bar');
    middle_bar.hide();

    $('#fast-button').on('submit', function (event){
        event.preventDefault();
        middle_bar.show();
    })

    $('#fast-add-form').on('submit', function (event){
        event.preventDefault();

        let form = $(this);

        $.ajax({
            url: '/src/actions/add_article.php',
            method: 'POST',
            dataType: 'json',
            data: {
                name: form.find('#article_name').val(),
                content: form.find('#article_content').val()
            },
            success: function (data){
                console.log(data);
            }
        })
    })

    $(document).on('submit', '#delete-form', function (event){
        event.preventDefault();

        let form = $(this);
        let article_id = form.find('[name="article_id"]').val();
        let article_name = form.find('[name="article_name"]').val();

        $.ajax({
            url: 'src/actions/delete_article.php',
            method: 'post',
            dataType: 'json',
            data: {
                article_id: article_id,
                article_name: article_name
            },
            success: function (data){
                console.log(data)
                alert(`Статья ${data['name']} успешно удалена!`)
            }
        })
    })

    // let slot = $('.article-table');
    // slot.append('<td><form action="article_page.php" method="post" style="padding: 0; margin: 0">\n' +
    //     '                <input type="hidden" name="article_id" value="2">\n' +
    //     '                <input type="hidden" name="article_name" value="Солнце">\n' +
    //     '                <input type="submit" value="<?=$row[\'name\']?>" style="color:hsl(205, 20%, 32%); background-color: white; border: none; margin: 0; padding: 0">\n' +
    //     '            </form></td>>')

    showArticles();
}

function showArticles(){
    $.ajax({
        url: "src/actions/articles_render.php",
        method: 'GET',
        dataType: 'json',
        success: function (data){
            console.log(data);
        }
    })
}