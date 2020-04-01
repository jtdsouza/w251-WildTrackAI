# w251-WIldTrackAI
WildTrack AI work (started with W251)


## Instructions for running Inference on TX2
Download puython scripts, models, pickle files,sample images adn docker build file to local drive on the TX2
These are all located in this GDrive folder: https://drive.google.com/open?id=1srD-FnmRypFVtHqbn3vQSFDRgWDmJNkP   
It would be simplest to just download the entire folder (for example: to /data/WildAI/ on the TX2) and preserve the subfolder structure.  


Build container from Docker file:  
*sudo docker build -t wildai_intake -f Dockerfile.tx2-4.3_b132-py3 .*


Run container in interactive mode: 
*sudo docker run --privileged --rm --it --name wildtrack -v /data/WildAI:/WildAI -p 8888:8888 -d wildai_intake*  

Note that we are just mapping the local folder to the /WildAI folder on the container (not using S3 just yet).   

To access shell for container:   
*sudo docker attach wildtrack*   


From command line in container, changed directory to /WildAI:  
*cd /WildAI*  
  
Run script:    
*python3 predict.py*
