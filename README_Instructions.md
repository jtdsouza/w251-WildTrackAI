# w251-WildTrackAI
WildTrack AI work (started with W251)


## Instructions for running Inference on TX2
Download data and models to local drive on the TX2. These are all located in this GDrive folder: https://drive.google.com/open?id=1srD-FnmRypFVtHqbn3vQSFDRgWDmJNkP 
It would be simplest to just download the entire folder (for example: to /data/WildAI/ on the TX2) and preserve the subfolder structure. There are some old files which have been archived in the archive folder - these are not needed to perform inference.

All dockerfiles and python scripts to perform inference and send messages are located in this repository under the folders wildaiIntake (inference), mqttLocBrk (local mosquitto broker), and mqttLocFor (local mosquitto forwarder). At the top of each dockerfile, you'll find the corresponding docker build and docker run scripts for each container. Note that you may need to edit the volume (-v) to point to the directory where you have copied the data, models, and repository folders referenced above.

You will first need to create a local network which I called "footprints" for my implementation (docker network create --driver bridge footprints). Subsequently each of the containers you create should reference this network in the docker run scripts. All docker run scripts (with the exception of the local broker) are set to run in interactive mode and connect to the appropriate working directory (-w) automatically to run the python scripts. So once you've launched the container, you should be able to just to type python3 and the name of the python script.


Previous Instructions
----
Build container from Docker file:  
*sudo docker build -t wildai_intake -f Dockerfile.tx2-4.3_b132-py3 .*

Run container in interactive mode:   

*sudo docker run --privileged --rm --it --name wildtrack -v /data/WildAI:/WildAI -p 8888:8888 -d wildai_intake*  

Note that we are just mapping the local folder to the /WildAI folder on the container (not using S3 just yet).   

To access shell for container:   
*sudo docker attach wildtrack*   


Or - to attach to container and correct working directory in one step

*sudo docker run --privileged --rm --it --name wildtrack -v /data/WildAI:/WildAI -p 8888:8888 -w /WildAI wildai_intake*


From command line in container, changed directory to /WildAI:  
*cd /WildAI*  
  
Run script:    
*python3 predict.py*
