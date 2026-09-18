function usuario(nome,data_nasc,email,senha){
    this.nome = nome;
    this.data_nasc = new Date(data_nasc);
    this.idade = calcula_idade(this.data_nasc)
    this.email = email;
    this.cadastro = new Date();
    let senha = senha;

    this.calcula_idade = function(){
        const hoje = new Date()
        let idade = hoje.getFullYear() - this.data_nasc.getFullYear();
        const m = hoje.getMonth() - this.data_nasc.getMonth();
        if (m < 0 || (m === 0 && hoje.getDate() < nascimento.getDate())) {
            idade--;
        }
        return idade;
    }

    this.tempo_cadastro = function(){
        const hoje = new Date();
        let tempo_calc = this.cadastro.getDate() - hoje.getDate();
        let tempo = new Date(tempo_calc);
        return tempo;
    }
}