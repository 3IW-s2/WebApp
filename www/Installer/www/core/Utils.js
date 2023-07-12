export default class Utils{
    static prop_access(obj, path, defaultValue = "default"){
        if(obj === null || !obj){
            return false;
        }

        if(path === null || path === "") return obj;

        const splittedPath = path.split(".");
        const splittedPathLength = splittedPath.length;
        for(let i = 0; i < splittedPathLength ; i++){
            if(typeof obj !== "object" || !(splittedPath[i] in obj)){
                return defaultValue;
            }
            obj = obj[splittedPath[i]];
        }
        return obj;
    }

}