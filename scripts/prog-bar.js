export class ProgBar {
    constructor(){
        this.dirSrc = "./assets/"
        this.filledFileExt = "-filled.png";
        this.emptyFileExt = "-empty.png";
        this.progFishElements = document.getElementsByClassName("progFish");
        this.colors = [
            "red", 
            "orange",
            "yellow", 
            "green",
            "bluePurple",
            "brown",
        ]
        this.update = function(newList) {
            for(const key in newList){
                let updateFish = document.querySelector("." + key + "Prog");
                if(newList[key] == 1){
                    updateFish.setAttribute('src', `${this.dirSrc}${key}${this.filledFileExt}`);
                }
                else {
                    updateFish.setAttribute('src', `${this.dirSrc}${key}${this.emptyFileExt}`);
                }
            }
        }
    }

}