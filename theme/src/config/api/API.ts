import axios from 'axios'

function handleErrorsPOST(data: any){
    if ('errors' in data){
        const errors = Object.values(data.errors);
        const finalErrors: any = [];
        errors.map(function (error: any) {
            error.map(function (e: any) {
                finalErrors.push(e);
            });
        });

        return {
            status: false,
            errors: finalErrors
        }
    }

    if ('errorsMessage' in data){
        const errors = Object.values(data.errorsMessage);
        const finalErrors: any = [];
        errors.map(function (error: any) {
            finalErrors.push(error);
        });

        return {
            status: false,
            errors: finalErrors
        }
    }

    return {
        status: false,
        errors: [
            "Ocurrio un error innesperado, por favor vuelva a intentarlo"
        ]
    }
}

function handleErrorsGET(error: any){
    if (error.response.data.message == "Unathorized"){
        return {
            status: false,
            errors: [
                "Accesos invalidos por favor verifique correo y contraseña"
            ]
        }
    }

    return {
        status: false,
        errors: [
            "Ocurrio un error innesperado, por favor vuelva a intentarlo"
        ]
    }
}

const API = {
    async GET(path: any = ""){
        try{
            const response = await axios.get(path);

            return response.data
        } catch (error: any){
            return handleErrorsGET(error);
        }
    },

    async POST(path: any, data: any){
        try{
            const response = await axios.post(path, data);

            return response.data;
        } catch (error: any){
            return handleErrorsPOST(error.response.data);
        }
    },

    async PUT(path: any, data: any){
        try{
            const response = await axios.put(path, data);

            return response.data;
        } catch (error: any){
            return handleErrorsPOST(error.response.data);
        }
    },

    async DELETE(path: any){
        try{
            const response = await axios.delete(path);

            return response.data;
        } catch (error: any){
            return handleErrorsPOST(error.response.data);
        }
    },
}

export { API };