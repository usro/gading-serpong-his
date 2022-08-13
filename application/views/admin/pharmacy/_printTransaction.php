<link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sh-print.css">
<?php
$currency_symbol = $this->customlib->getHospitalCurrencyFormat();
?>
<div class="print-area">
<div class="row">
        <div class="col-12">
               <?php if (!empty($print_details[0]['print_header'])) { ?>
                        <div class="pprinta4">
                            <img src="<?php
                            if (!empty($print_details[0]['print_header'])) {
                                echo base_url() . $print_details[0]['print_header'].img_time();
                            }
                            ?>" class="img-responsive" style="height:100px; width: 100%;">
                        </div>
                    <?php } ?>
           <div class="card">
                <div class="card-body">  
                    <div class="row"> 
                        <div class="col-md-6">
                            <p><?php echo $this->lang->line('patient'); ?> : <?php echo composePatientName($transaction->patient_name,$transaction->patient_id); ?></p>
                            <p><?php echo $this->lang->line('case_id'); ?> : <?php if($transaction->case_reference_id != 0){echo $transaction->case_reference_id;} ?></p>
                        </div>

                        <div class="col-md-6 text-right">
                            <p><span class="text-muted"><?php echo $this->lang->line('transaction_id'); ?>: </span> <?php echo $this->customlib->getSessionPrefixByType('transaction_id').$transaction->id; ?></p>
                            <p><span class="text-muted"><?php echo $this->lang->line('date'); ?>: </span>
                            <?php echo date($this->customlib->getHospitalDateFormat(true, true), strtotime($transaction->payment_date)); ?>
                            </p>              
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                              <table class="print-table">
                             <thead>
                                <tr class="line">
                                   <td><strong>#</strong></td>
                                   <td><strong><?php echo $this->lang->line('description'); ?></strong></td>
                                   <td class="text-right"><strong><?php echo $this->lang->line('amount').' ('.$currency_symbol.')'; ?></strong></td>
                                </tr>
                             </thead>
                             <tbody>
                                <tr>
                                <?php 
                                  if($transaction->type == "payment"){
                                  $payment_type= $this->lang->line("payment_received");
                                  }elseif ($transaction->type == "refund") {
                                   $payment_type= $this->lang->line("payment_refund");
                                  }
                                 ?>
                                   <td>1</td>
                                   <td><strong><?php echo $payment_type; ?></strong><br>
                                    <?php
                                     echo $this->lang->line("by"). ": ".$this->lang->line(strtolower($transaction->payment_mode));
                                     if($transaction->payment_mode == "Cheque"){
                                       echo " ".$transaction->cheque_no;
                                     }
                                      if($transaction->payment_mode == "Cheque"){
                                    echo "<br>";
                                       echo $this->customlib->YYYYMMDDTodateFormat($transaction->cheque_date);
                                     }
                                      ?></td>
                                   <td class="text-right"><?php echo $transaction->amount ?></td>
                                </tr>
                                <tr>
                                   <td colspan="1"></td>
                                   <td class="text-right"><strong><?php echo $this->lang->line('total'); ?></strong></td>
                                   <td class="text-right"><strong><?php echo $currency_symbol.$transaction->amount ?></strong></td>
                                </tr>
                                <tr>
                                   <td colspan="3"><?php echo $this->lang->line('note').': '.$transaction->note ?></td>
                                   
                                   
                                </tr>
                                
                             </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear">
              <p>
                <?php
                if (!empty($print_details[0]['print_footer'])) {
                    echo $print_details[0]['print_footer'];
                }
                ?>                          
            </p>
          </div>
        </div>
    </div>
</div>