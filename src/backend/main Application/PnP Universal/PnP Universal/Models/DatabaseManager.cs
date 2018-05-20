using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;

namespace PnP_Universal.Models
{
    public class Author
    {
        public int Id { get; set; }
        [Required]
        public string Name { get; set; }
    }
}