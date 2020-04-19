# Code Artifacts and Setup Instructions

## Data and Image Pre-Proessing  
The Raw Data Images are stored in a shared Google Drive (for ease of collaboration with WIldTrack founders) as well as on an S3 Mount.
The WildAID_PreProcess.ipynb in the "Models" subfolder of this repository is what we used to process these images to use as inputs for various models. 

## Model Development and Training  

Model development and training was mostly done on Google Colab (using the GPU/ High RAM option) for ease of collaboration across various team members and it's integration with Google Drive which was our primary means of collaboration with the WIldTrack Founders as well.   
ALl the word done during model development is captured in these notebooks (in the Models subfolder of this repository)

- Species Classification Model Training & Eval: WildAI_Species_Classification.ipynb
- Individal ID Model Training (Using Triples): WildAI_Individual_ID_Training.ipynb
- Individual ID Model Evaluation: WildAI_IndividualID_Evaluation.ipynb  

## Instructions for running Inference on TX2
- **Step 1:** Clone this Repository
- **Step 2:** Download data and models to a local root directory on the TX2 called “WildAI”. These are all located in the following GDrive folder: https://drive.google.com/open?id=1srD-FnmRypFVtHqbn3vQSFDRgWDmJNkP. Note: It is important to preserve the subfolder structure (i.e. /WildAI/models; /WildAI/data).
- **Step 3:** Create a local network (i.e. "footprints") so that the edge-based docker containers can communicate.
`docker network create --driver bridge footprints`
- **Step 4:** Create docker image and launch Edge Inference container. The Dockerfile is located in the w251-WildTrackAI/edge_inference directory. Note: the docker image for this container is based on an image called w251/tensorrt:dev-tx2-4.3_b132 available on Docker Hub. This image takes a while to build, so allow 30-40 mins. The volume created (-v) will give you access to the predict.py script necessary to perform inference.
`docker build -t edge_inference -f Dockerfile.dev-tx2-4.3_b132-py3 .`
`docker run –privileged -it --name edge_inference --network footprints -v /w251-WildTrackAI/edgeInference:/app -w /app edge_inference`
- **Step 5:** Create docker image and launch Edge Broker container. The Dockerfile is located in the w251-WildTrackAI/edgeMqttBrk directory. Note: upon running this container, Mosquitto will be launched automatically. 
`docker build -t edge_mqtt_broker .`
`docker run --name edge_mqtt_broker --network footprints -p 1883:1883 edge_mqtt_broker`
- **Step 6:** Create docker image and launch Edge Forwarder container.  The Dockerfile is located in the w251-WildTrackAI/edgeMqttFor directory. The working directory (-w /app) command in the docker run script will launch the container directly into the appropriate directory to access the forwarding script, run.py. 
`docker build -t edge_mqtt_forwarder .`
`docker run -it --name edge_mqtt_forwarder --network footprints -v /w251-WildTrackAI/edgeMqttFor:/app -w /app edge_mqtt_forwarder`

Download data and models to local drive on the TX2. These are all located in this GDrive folder: https://drive.google.com/open?id=1srD-FnmRypFVtHqbn3vQSFDRgWDmJNkP 
It would be simplest to just download the entire folder (for example: to /data/WildAI/ on the TX2) and preserve the subfolder structure. There are some old files which have been archived in the archive folder - these are not needed to perform inference.

All dockerfiles and python scripts to perform inference and send messages are located in this repository under the folders wildaiIntake (inference), mqttLocBrk (local mosquitto broker), and mqttLocFor (local mosquitto forwarder). At the top of each dockerfile, you'll find the corresponding docker build and docker run scripts for each container. Note that you may need to edit the volume (-v) to point to the directory where you have copied the data, models, and repository folders referenced above.

You will first need to create a local network which I called "footprints" for my implementation (docker network create --driver bridge footprints). Subsequently each of the containers you create should reference this network in the docker run scripts. All docker run scripts (with the exception of the local broker) are set to run in interactive mode and connect to the appropriate working directory (-w) automatically to run the python scripts. So once you've launched the container, you should be able to just to type python3 and the name of the python script.

## Instructions for the database

The database structure is as follow:

![](Images/database.png)

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
