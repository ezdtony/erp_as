<style>
    #draw-canvas {
        border: 2px dotted #CCCCCC;
        border-radius: 5px;
        cursor: crosshair;
    }

    #draw-dataUrl {
        width: 100%;
    }

    .contenedor {
        width: 100%;
        margin: 5px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .instrucciones {
        width: 90%;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
    }


    input[type=range] {
        -webkit-appearance: none;
        margin: 18px 0;

    }

    input[type=range]:focus {
        outline: none;
    }

    input[type=range]::-webkit-slider-runnable-track {
        width: 100%;
        height: 8.4px;
        cursor: pointer;
        animate: 0.2s;
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
        background: #3071a9;
        border-radius: 1.3px;
        border: 0.2px solid #010101;
    }

    input[type=range]::-webkit-slider-thumb {
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
        border: 1px solid #000000;
        height: 36px;
        width: 16px;
        border-radius: 3px;
        background: #ffffff;
        cursor: pointer;
        -webkit-appearance: none;
        margin-top: -14px;
    }

    input[type=range]:focus::-webkit-slider-runnable-track {
        background: #367ebd;
    }

    input[type=range]::-moz-range-track {
        width: 100%;
        height: 8.4px;
        cursor: pointer;
        animate: 0.2s;
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
        background: #3071a9;
        border-radius: 1.3px;
        border: 0.2px solid #010101;
    }

    input[type=range]::-moz-range-thumb {
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
        border: 1px solid #000000;
        height: 36px;
        width: 16px;
        border-radius: 3px;
        background: #ffffff;
        cursor: pointer;
    }

    input[type=range]::-ms-track {
        width: 100%;
        height: 8.4px;
        cursor: pointer;
        animate: 0.2s;
        background: transparent;
        border-color: transparent;
        border-width: 16px 0;
        color: transparent;
    }

    input[type=range]::-ms-fill-lower {
        background: #2a6495;
        border: 0.2px solid #010101;
        border-radius: 2.6px;
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
    }

    input[type=range]::-ms-fill-upper {
        background: #3071a9;
        border: 0.2px solid #010101;
        border-radius: 2.6px;
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
    }

    input[type=range]::-ms-thumb {
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
        border: 1px solid #000000;
        height: 36px;
        width: 16px;
        border-radius: 3px;
        background: #ffffff;
        cursor: pointer;
    }

    input[type=range]:focus::-ms-fill-lower {
        background: #3071a9;
    }

    input[type=range]:focus::-ms-fill-upper {
        background: #367ebd;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <canvas id="draw-canvas" width="350" height="360">
            No tienes un buen navegador.
        </canvas>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <button type="button" id="draw-clearBtn" class="btn btn-warning">Limpiar</button>
        <button type="button" id="draw-submitBtn" class="btn btn-primary">Guardar Firma</button>

        <label>Color</label>
        <input type="color" id="color">
        <label>Tamaño Puntero</label>
        <input type="range" id="puntero" min="1" default="1" max="5" width="10%">


    </div>

</div>
<br />
<div class="row">
    <div class="col-md-12" style="display:none">
        <textarea id="draw-dataUrl" class="form-control" rows="5">Para los que saben que es esto:</textarea>
    </div>
</div>
<br />
<div class="contenedor">
    <div class="col-md-12">
        <img id="draw-image" src="" alt="Previzualice la firma antes de continuar:" />
    </div>
</div>