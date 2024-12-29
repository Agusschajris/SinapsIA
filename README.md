# SinapsIA
We are developing a website aimed at neurologists specialized in epilepsy to make their work easier. On this site, they can keep records of their patients, and it also has integrated AI that detects manifestations of epilepsy in electroencephalograms.

### Integrantes y roles
- Agustina Schajris Garati (**Artificial Intelligence** - dataset and model)
- Alvaro Saravia (**Artificial Intelligence** - model connection with the back-end)
- Emma Killian (**Front-End and Design**)
- Jano Portnoi (**Back-End**)
- Tomas "Blur" Spurio (**New Back-end**)

## Artificial Intelligence
The AI is designed to analyze .npy files containing electroencephalogram (EEG) recordings. We were unable to use an input format compatible with what the doctors receive because the response regarding the formats from the foundation that was helping us arrived at a time that made it impossible to adapt what we had already done to a completely new and unfamiliar format for the final project delivery.

### Dataset
The base dataset used is the [Guinea Bissau and Nigeria Epilepsy Dataset](https://www.kaggle.com/datasets/abhishekinnvonix/epilepsy-guinea-bissau-dataset), which was mostly processed in the `procesamientoInicialDataset.ipynb` document. Then, the processing continued in the `X_dimensionalReduction.ipynb` document, where PCA (Principal Component Analysis) was applied, and the dataset was reshaped for the model's input. In the `New data.ipynb` file, new data from the dataset [EEG data collected with Emotiv device in people with epilepsy and controls in Guinea-Bissau and Nigeria](https://zenodo.org/records/1252141) (only the Nigeria part) began to be processed. However, due to time constraints, this data could not be included in the final dataset. Given the final dataset's size, it is not uploaded to GitHub. It is stored on a school computer and weighs 43GB.

### Model
The model is a convolutional neural network (CNN) for binary classification. It is built from a pre-trained ResNet-50 base model, with additional dense layers added to tailor it to your data and produce a suitable output for your task. The output consists of a single neuron, and its activation function is the sigmoid function, which allows for percentage approximations (a value closer to `0` indicates a lower probability of having epilepsy, while a value closer to `1`indicates a higher probability of having epilepsy). TensorFlow was the primary tool used for developing this neural network. The model construction, training, and evaluation can be found in the `MODELO FINAL.ipynb` file.

![Arquitectura del modelo](https://github.com/Agusschajris/Proyecto-4to-SinapsIA/blob/main/IA/Agus/Captura%20de%20pantalla%202023-11-22%20111647.png) 
