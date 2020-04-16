# w251-WildTrackAI
WildTrack AI work (started with W251)

## 1. Introduction (Jonathan)
WildTrack is a non-profit organization whose mission is to protect endangered species via non-invasive and cost-effective monitoring using footprints. Commonly-used wildlife monitoring techniques rely on fitting of instrumentation to an animal (transmitter on a collar, tag, insert), marking, capture or close visual observation, which have shown to have counterproductive effects on conservation efforts.  

### 1.1 Problem 
For a variety of reasons, raw images of footprints collected in the field still need a fair amount of processing before they are ready to be analyzed, which requires human labor. Furthermore, location of new trails and/ or areas to capture new footprint images is a very manual exercise. These are the main impediments to timely processing and analysis of animal tracks in support of use cases that mitigate human wildlife conflicts and prevent illegal poaching.
### 1.2 Approach 
This project uses state of the art Deep Learning techniques (specifically employing Convolutional Neural Networks)  for image detection and identification to improve the speed and efficiency of the current workflow to collect, pre-process and analyze footprints using FIT. We outline these methods and select the most adequate model to be utilized at the edge, fulfilling requirements to be on-boarded on a portable device and/or drone for inference in real time. We also explore how wide range images captured via drones can be used to further improve the efficacy of Wildlife Tracking.  

Finally, we propose a practical implementation of an end to end solution using these methods on an edge device to collect and capture data saved in the cloud for further processing and model improvement.  
- **Phase 1**: Footprint Classification
- **Phase 2**: Individual Identification
- **Phase 3**: Footprint Detection

## 2. Data Cleansing
Crop images and separate into test and train

## 3. Modeling
3.1 Create model for species and individual ID classification  
3.2 Evaluate models: number of parameters, size, accuracy (Bona)  
3.3 Come up with final model  

## 4. Pipeline (Mike)
### 4.1 Flowchart
### 4.2 Components
### 4.3 Front End (Dan, Jacques)
Geo tagging, meta data
Html file
Display footprint and information on map

## 5. Other: 
### 5.1 Augmentation (Dan)
### 5.2 Object detection (Mike, Tina)

## 6. Future Steps (Everyone)
- **Object Detection**: The team sees a real opportunity to streamline the image collection and inference process by implementing an object detection system whereby the model could detect footprints from images or videos taken from a further distance vs. closeup images taken at a very specific orientation. Subsequently, we envision an implementation similar to YOLO whereby the model could perform classification in realtime through the camera of a mobile device applying an object detection algorithm. 
- **Pipeline Optimization**: With the exception of the "intake" container, which loads the pretrained models and performs inference, the pipeline is very light, with the containers totalling ###MB. However, the intake container does require some additional work to reduce its' size to be more mobile-friendly. This could be achieved through the identification of a more mobile-friendly model, or through reconfiguring a streamlined container that can still perform the necessary functionality.
- Model Enhancement
- Productionalization
- Real-time Image Augmentation
