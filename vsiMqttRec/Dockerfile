#docker run -it --name vsi_mqtt_receiver --network cloud-wildtrack-ai -v /mnt/wildtrack-ai/new-files:/mnt/wildtrack-ai/new-files -v /root/:/app/ -w /app/ vsi_mqtt_receiver

FROM ubuntu

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    curl \
    git \
    python3.6 \
    python3-pip \
    python-opencv \
    python3-opencv \
    mosquitto-clients \
    vim \
    iputils-ping \
    libhdf5-dev \
    python3-numpy \
    python3-setuptools \
    python3-h5py \
    python3-wheel
RUN apt-get clean

RUN pip3 install paho-mqtt
RUN pip3 install opencv-python

