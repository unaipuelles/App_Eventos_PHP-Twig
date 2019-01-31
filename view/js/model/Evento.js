class Evento{
    constructor(id, nombre, tipo, fecha, descripcion, lugar){
        this._id = id;
        this._nombre = nombre;
        this._tipo = tipo;
        this._fecha = fecha;
        this._descripcion = descripcion;
        this._lugar = lugar;
    }

    get id() {
        return this._id;
    }

    set id(value) {
        this._id = value;
    }

    get nombre() {
        return this._nombre;
    }

    set nombre(value) {
        this._nombre = value;
    }

    get tipo() {
        return this._tipo;
    }

    set tipo(value) {
        this._tipo = value;
    }

    get fecha() {
        return this._fecha;
    }

    set fecha(value) {
        this._fecha = value;
    }

    get descripcion() {
        return this._descripcion;
    }

    set descripcion(value) {
        this._descripcion = value;
    }

    get lugar() {
        return this._lugar;
    }

    set lugar(value) {
        this._lugar = value;
    }
}