<div>
    <form ID="waiting-form" name="waiting" action="" method="post" >  
        <div>
            <h2 style='font-size: 1.7em'>設 定 會 議 標 題 和 刷 卡 時 間 </h2>
        </div>
        <div class="w_row">
            <div>
                <label>會議標題</label>
            </div>
            <div>
                <input type="text"
                       id="txt_title"
                       name='txt_title'
                       value="<?php echo get_option('_title_text') ?>"
                       />
            </div>        
        </div>
        <div class="w_row">
            <div>                
                <label>刷卡時間</label>
            </div>
            <div>
                <input type="text"
                       id="txt_waiting"
                       name='txt_waiting'
                       value="<?php echo get_option('_waiting_text') ?>"
                       />
            </div>        
        </div>
        <div style=" width: 63%; text-align: right">
            <input name="submit" id="submit" 
                   class="button button-primary" 
                   value="發 表" type="submit" 
                   style="margin-top: 30px"> 
        </div>
    </form>    
</div>
<style>
    .w_row {
        width: 90%;
        margin-bottom: 15px;
        /*height: 35px;*/
    }

    .w_row div{
      /*display: inline-block;*/
       margin-left: 20px;
       margin-bottom: 3px;
    }
    
    .w_row label{
        font-weight: bold;
        font-size: 1.2em;
    }
    
    .w_row input[type="text"]{
        width: 70%
    }
</style>
