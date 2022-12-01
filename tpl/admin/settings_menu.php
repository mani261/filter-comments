<?php

if (get_option ('_fc_words')) {
    $fc_option = true;
}

if ($_POST['submit']) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $str = $_POST['filtered_words'];
        $words = explode (',', $str);

        if ($fc_option) {
            update_option ('_fc_words', $words);
        } else {
            add_option ('_fc_words', $words);
        }
    }
}

if ($fc_option) {
    $pre_words = get_option ('_fc_words');
    $pre_words_str = implode (',', $pre_words);
}

?>

<div class="wrap">
    <h1 class="wp-heading-inline"><?php echo esc_html (get_admin_page_title ()); ?></h1>
    <form action="" method="post">
        <table class="form-table">
            <tbody>
            <tr>
                <th>Filter Words</th>
                <td>
                    <p>
                        <label for="filtered_words">Please insert words with comma (,) separator</label>
                    </p>
                    <p>
                        <textarea name="filtered_words" id="filtered_words" class="large-text code" cols="30"
                                  rows="10"><?php echo $fc_option ? $pre_words_str : ''; ?></textarea>
                    </p>
                </td>
            </tr>
            <tr>

            </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" name="submit" class="button button-primary" value="Save changes">
        </p>
    </form>
</div>