export default class Utils {
    static prop_access(obj, path, defaultValue = "default") {
        // Vérifie si l'objet est null ou non défini
        if (obj === null || !obj) {
            return false;
        }

        // Vérifie si le chemin est null ou une chaîne vide, dans ce cas, retourne l'objet d'origine
        if (path === null || path === "") {
            return obj;
        }

        // Divise le chemin en segments
        const splittedPath = path.split(".");
        const splittedPathLength = splittedPath.length;

        // Parcourt chaque segment du chemin
        for (let i = 0; i < splittedPathLength; i++) {
            // Vérifie si l'objet est de type "object" et si le segment existe en tant que propriété de l'objet
            if (typeof obj !== "object" || !(splittedPath[i] in obj)) {
                return defaultValue;
            }
            // Accède à la propriété correspondant au segment du chemin
            obj = obj[splittedPath[i]];
        }

        // Retourne la valeur finale de l'objet correspondant au chemin
        return obj;
    }
}
