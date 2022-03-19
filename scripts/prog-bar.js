export class ProgBar {
    constructor(){
        this.dirSrc = "./assets/"
        this.filledFileExt = "-filled.png";
        this.emptyFileExt = "-empty.png";
        this.allComplete = false;
        this.completeCount = 0;
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
                    this.completeCount += 1;
                }
                else {
                    updateFish.setAttribute('src', `${this.dirSrc}${key}${this.emptyFileExt}`);
                }
            }
            if (this.completeCount >= Object.keys(newList).length){
                this.allComplete = true;
            }
        }


    }

}