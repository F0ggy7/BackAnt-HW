# BackAnt-HW

<?php
    class is_validate_card{
        public function Validate_card($NumberCard) { 
            $NumberCard = strrev(preg_replace('/\D/','',$NumberCard));
            $sum = 0;
            for ($i = 0; $i < strlen($NumberCard); $i++) {
                if (($i % 2) == 0) {
                    $val = $NumberCard[$i];
                } else {
                    $val = $NumberCard[$i] * 2;
                    if ($val > 9) $val -= 9;
                }
                $sum += $val;
            }

            $result = false;
            if (($sum % 10) == 0) {
             $result = true;
            }

            if ($result == true){
                $out_valid = 'Валидная';
            }

            if ($result == false){
                $out_valid = 'Невалидная';
            }

            return $out_valid;
        }

        public function Validate_card_emitent($NumberCard) { 
            $mastercard_emitent = '/\A(5[1-5]|62|67)\d+/';
            $visa_emitent = '/\A(4[0-9]|14)\d+/';

            $output_emit = 'Неизвестный эмитент';

            if(preg_match($mastercard_emitent, $NumberCard)) {
             $output_emit = 'MasterCard';
            }
   
            if(preg_match($visa_emitent, $NumberCard)) {
             $output_emit = 'Visa';
            }
            
            return $output_emit;
        }
    }

    $is_validate_card = new is_validate_card();
    $NumberCard = fgets(STDIN);

    echo $is_validate_card->Validate_card($NumberCard), $is_validate_card->Validate_card_emitent($NumberCard);
?>
