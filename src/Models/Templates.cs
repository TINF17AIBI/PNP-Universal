using System;
using System.Collections.Generic;

namespace PnP_Universal.Models
{
    public partial class Templates
    {
        public int Id { get; set; }
        public int Creator { get; set; }
        public string Name { get; set; }
        public string Description { get; set; }

        public Users IdNavigation { get; set; }
        public Adventures Adventures { get; set; }
        public Attributes Attributes { get; set; }
        public Heroes Heroes { get; set; }
    }
}
