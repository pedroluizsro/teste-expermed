import React from "react";

class Form extends React.Component {

    constructor(props) {
        super(props);

        //Define estados iniciais.
        this.state = {entrada: '', encrypt:''};

        this.change = this.change.bind(this);
    }

    /**
     * Função executada sempre que há uma alteração no campo.
     * Realiza execução do upload do arquivo.
     *
     * @param event
     */
    change(event){

        const formData = new FormData();

        this.setState({files: event.target.files},() => {
            for(var i=0; i < this.state.files.length; i++){
                formData.append(this.state.files[i].name,this.state.files[i]);
            }

            this.upload(formData);
        });


    }

    /**
     * Se comunica com a API realizar upload
     * dos arquivos.
     * @param formData
     */
    upload(formData){

        fetch('http://localhost:5000/api/index.php',{
            method: 'POST',
            body: formData
        }).then(function (resultado) {
            return resultado.json();
        }).then(function (resultado) {
            resultado.forEach(function (resultado) {
                var entradas = document.getElementById('entradas');
                entradas.innerHTML += resultado+'<br/>';
            })
        });

    }

    render(){
        return (
            <div>
                <form onSubmit={this.submit}>
                    <input type="file" name="arquivos" onChange={this.change} multiple/>
                </form>
                <a href="../datfile/data/in">Arquivos de entrada</a>
                <br/>
                <a href="../datfile/data/out">Arquivos de Saída</a>
                <div id="entradas">
                    <br/>
                    <b>Resuldado da importação: </b>
                    <br/>

                </div>
            </div>
        )
    }
}

export default Form;
