<!DOCTYPE html>
<html>
    <div class="footer">

        <hr>
        <div class="contenido">
            <div class="footer-brand">
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" width="100" height="100" alt="">
                </div>
                
                <div class="ubicacion">
                Carr. de San Vicente del Raspeig, s/n, <br>
                03690 San Vicente del Raspeig, Alicante
                 
                </div>
            </div>
            
            <div class="crypto">
              
                    <img src="{{ asset('images/footer/footer1.jpg') }}" width="300" height="145" alt="">
                
                    <img src="{{ asset('images/footer/footer2.jpg') }}" width="300" height="155" alt="">
            
                
            </div>
        </div>
        <hr>
        <div class="dsg-chain">
            <div class="icon-copy">
                <img src="{{ asset('images/footer/copyR.png') }}" width="20" height="20" alt="">
            </div>
            <div class="name">. DSG CHAIN</div>
        </div>
        

        

    </div>

</html>

<style lang="scss">
    .footer{
        height: 240px;
        left: 0;
        bottom: 0;
        width: 100%;
        
    }
    
    
    .contenido{
        justify-content: center;
        height: 160px;
        display: flex;
        align-items: center;
        

    }

    .footer-brand{
        display: flex;
        align-items: flex-end;
    }

    .crypto{
        margin-left: 15%;
        opacity: .3;
        
    }
    .ubicacion{
        margin-left: 10px;
        font-style: oblique;
        opacity: .8;
    }

    .dsg-chain{
        display: flex;
        align-items: center;
        justify-content: flex-start;

    }
    @media(max-width: 1230px){
        .crypto{
            display:none;
        
        }
    }
</style>