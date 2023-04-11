<?php

abstract class FormsDoc extends BasicDoc {

    protected function show_form_start($div_class, $form_class, $extra_option=""){
        echo '<div class="'.$div_class.'">
        <form class="'.$form_class.'" method="post" action="index.php"
        '.$extra_option.'>
        <span class="error">'; echo $this->get_variable($this->model->errors,"generic"); echo '</span><br>';
    }

    protected function show_form_field($field_name, $label, $type, $error_name, $options=NULL){
            
        echo '<label>'.$label.'</label>';
        switch($type){
            case "textarea":
                echo
                '<br><textarea id="'.$field_name.'" name="'.$field_name.'">'; echo $this->get_variable($this->model->values,$field_name); echo '</textarea>
                <span class="error">'; echo $this->get_variable($this->model->errors, $error_name); echo '</span><br>';
                break;
            case "radio":
                echo '<br><span class="error">'; echo $this->get_variable($this->model->errors,  $error_name); 
                
                echo '</span><br>';
                foreach ($options as $option) {
                    echo '<input type="radio" name="'.$field_name.'" value="'.$option.'"';
                    if ($this->get_variable($this->model->values, $field_name) == $option) {
                        echo 'checked="checked"';
                    }
                    echo '><label for="">'.$option.'</label><br>';
                }
                break;
            case "select":
                echo '<span class="error">'; echo $this->get_variable($this->model->errors,$error_name); echo'</span><br><br>
                <select id="'.$field_name.'" name="'.$field_name.'">';
                
                foreach ($options as $option) {
                    echo '<option value="'.$option.'"';
                    if ($this->get_variable($this->model->values,$field_name) == $option){
                        echo ' selected="selected"';}
                    echo'>'.$option.'</option>';
                }
                echo '</select><br><br>';
                break;
            default:
                echo '<br><input type="'.$type.'" name="'.$field_name.'" value="'; echo $this->get_variable($this->model->values,$field_name); echo '">
                <span class="error">'; echo $this->get_variable($this->model->errors,$error_name); echo'</span><br><br>';
        }
    }
    
    protected function cart_button($id, $place, $action) {
    
        echo '<div class="cart_button">
        <form action="index.php" method="post">
        <input type="hidden" name="page" value="'. $this->model->page .'" />
        <input type="hidden" name="id_in_cart" value="'.$id.'" />
        <input type="hidden" name="place" value="'.$place.'" />
        <input type="hidden" name="action" value="'. $action .'" />';
    
        switch  ($action) {
            case 'add':
                switch($place){
                    case "overview":
                        echo '<input type="hidden" name="amount" value="1" />';
                        break;
                    default:
                        $this->show_form_field("amount","Amount:","select", "amount", array(1,2,3,4,5,6,7,8,9));
    
                }
                $submit_value = "Add to cart";
                break;
            case 'remove':
                echo '<input type="hidden" name="amount" value="1" />';
                $submit_value = "Remove from cart";
                break;
        } 
    
        echo'
        <input type="submit" value="'. $submit_value .'">
        </form>
        </div>
        ';
    }
    
    function show_form_end($submit_text,$page){
        echo
        '<input type="hidden" name="page" value="'.$page.'"><br>
        <input type="submit" value="'.$submit_text.'">
        </form>
        </div>
        ';
    }
}


?>